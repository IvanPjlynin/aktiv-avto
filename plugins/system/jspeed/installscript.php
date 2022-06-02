<?php
/**
 * Application install script
 * @author Joomla! Extensions Store
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html    
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Installer\Installer;

/** 
 * Application install script class
 */
class PlgsystemJspeedInstallerScript {
	/*
	* Find mimimum required joomla version for this extension. It will be read from the version attribute (install tag) in the manifest file
	*/
	private $minimum_joomla_release = '4.0';
	
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
	 * If preflight returns false, Joomla will abort the update and undo everything already done.
	 */
	function preflight($type, $parent) {
		// Check for Joomla compatibility
		if(version_compare(JVERSION, $this->minimum_joomla_release, '<')) {
			Factory::getApplication()->enqueueMessage (Text::sprintf('PLG_JSPEED_INSTALLING_VERSION_NOTCOMPATIBLE', JVERSION), 'error');
			
			if(version_compare(JVERSION, '3.10', '<')) {
				Factory::getApplication()->enqueueMessage (Text::sprintf('Error, installation aborted. Pay attention! You are attempting to install a component package for Joomla 4 that does not match your actual Joomla version. Download and install the correct package for your Joomla %s version.', JVERSION), 'error');
			}
			return false;
		}
	}
	
	/*
	 * $parent is the class calling this method.
	 * install runs after the database scripts are executed.
	 * If the extension is new, the install method is run.
	 * If install returns false, Joomla will abort the install and undo everything already done.
	 */
	function install($parent, $isUpdate = false) {
		// Reset any previous messages queue, keep only strict installation messages since now on
		$app = Factory::getApplication();
		$app->getMessageQueue(true);
		
		// Evaluate nonce csp feature
		$appNonce = $app->get('csp_nonce', null);
		$nonce = $appNonce ? ' nonce="' . $appNonce . '"' : '';
		echo ('<link rel="stylesheet" type="text/css"' . $nonce . ' href="' . Uri::root ( true ) . '/administrator/components/com_jspeed/css/bootstrap-install.css' . '" />');
		echo ('<script type="text/javascript"' . $nonce . ' src="' . Uri::root ( true ) . '/media/vendor/jquery/js/jquery.min.js' .'"></script>' );
		echo ('<script type="text/javascript"' . $nonce . ' src="' . Uri::root ( true ) . '/administrator/components/com_jspeed/js/installer.js' .'" defer></script>' );
		
		$parentParent = $parent->getParent();
		
		$database = Factory::getContainer()->get('DatabaseDriver');
		
		// Component installer
		$pluginInstaller = Installer::getInstance ();
		$pathToAdminComponent = $pluginInstaller->getPath ( 'source' ) . '/component';
		
		echo ('<div class="installcontainer">');
		$componentInstaller = new Installer ();
		if (! $componentInstaller->install ( $pathToAdminComponent )) {
			echo '<p>' . Text::_ ( 'PLG_JSPEED_ERROR_INSTALLING_COMPONENT' ) . '</p>';
			// Install failed, rollback changes
			$parentParent->abort(Text::_('PLG_JSPEED_ERROR_INSTALLING_COMPONENT'));
			return false;
		} else {
			// Publish the plugin only on the first install
			if(!$isUpdate) {
				$query = "UPDATE #__extensions" . "\n SET enabled = 1, ordering = 9999" .
						 "\n WHERE type = 'plugin' AND element = " . $database->quote ( 'jspeed' ) .
						 "\n AND folder = " . $database->quote ( 'system' );
				$database->setQuery ( $query );
				if (! $database->execute ()) {
					echo '<p>' . Text::_ ( 'PLG_JSPEED_ERROR_PUBLISHING_PLUGIN' ) . '</p>';
				}
			}
			
			// Kill the component update server
			$query = "DELETE FROM  #__update_sites" .
					 "\n WHERE " . $database->quoteName('location') . " LIKE " . $database->quote ( '%storejextensions.org/updates/dummy.xml%' );
			$database->setQuery ( $query )->execute();

			?>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
					<span class="step_details"><?php echo Text::_('PLG_JSPEED_OK_INSTALLING_COMPONENT');?></span>
				</div>
			</div>
			<?php 
		}
		
		// INSTALL ADMIN MODULE - Current installer instance
		$pathToAdminModule = $pluginInstaller->getPath ( 'source' ) . '/module';
		// New module installer
		$moduleInstaller = new Installer ();
		if (! $moduleInstaller->install ( $pathToAdminModule )) {
			echo '<p>' . Text::_ ( 'PLG_JSPEED_ERROR_INSTALLING_ADMIN_MODULE' ) . '</p>';
		} else {
			// Publish the module only on the first install
			if(!$isUpdate) {
				$query = "UPDATE #__modules" .
						 "\n SET " . $database->quoteName('published') . " = 1," .
						 "\n" . $database->quoteName('position') . " = " . $database->quote('cpanel') . "," .
						 "\n" . $database->quoteName('ordering') . " = 999" .
						 "\n WHERE " . $database->quoteName('module') . " = " . $database->quote('mod_jspeed') .
						 "\n AND " . $database->quoteName('client_id') . " = 1";
				$database->setQuery($query);
				if(!$database->execute()) {
					echo Text::_('PLG_JSPEED_ERROR_PUBLISHING_ADMIN_MODULE');
				}
				
				// Publish all pages for default on joomla1.6+
				$query	= $database->getQuery(true);
				$query->select('id');
				$query->from('#__modules');
				$query->where($database->quoteName('module') . '=' . $database->quote('mod_jspeed'));
				$query->where($database->quoteName('client_id') . '= 1');
				
				$database->setQuery($query);
				$lastIDForModule = $database->loadResult();
				
				// Now insert
				try {
					$query	= $database->getQuery(true);
					$query->insert('#__modules_menu');
					$query->set($database->quoteName('moduleid') . '=' . $database->quote($lastIDForModule));
					$query->set($database->quoteName('menuid') . '= 0');
					$database->setQuery($query);
					$database->execute();
				} catch (\Exception $e) {
					// Already existing no insert - do nothing all true
				}
			}
			
			?>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
					<span class="step_details"><?php echo Text::_('PLG_JSPEED_OK_INSTALLING_MODULE');?></span>
				</div>
			</div>
			<?php 
		}
		
		?>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				<span class="step_details"><?php echo Text::_('PLG_JSPEED_OK_INSTALLING_PLUGIN');?></span>
		  	</div>
		</div>
		<?php 
		echo ('</div>');
		
		return true;
	}
	
	/*
	 * $parent is the class calling this method.
	 * update runs after the database scripts are executed.
	 * If the extension exists, then the update method is run.
	 * If this returns false, Joomla will abort the update and undo everything already done.
	 */
	function update($parent) {
		$this->install($parent, true);
	}
	
	
	/*
	 * $parent is the class calling this method
	 * uninstall runs before any other action is taken (file removal or database processing).
	 */
	function uninstall($parent) {
		$database = Factory::getContainer()->get('DatabaseDriver');
		 
		// Check if system plugin exists
		$query = "SELECT extension_id" .
				 "\n FROM #__extensions" .
				 "\n WHERE type = 'component' AND element = " . $database->quote('com_jspeed');
		$database->setQuery($query);
		$componentID = $database->loadResult();
		if(!$componentID) {
			echo '<p>' . Text::_('PLG_JSPEED_COMPONENT_ALREADY_REMOVED') . '</p>';
		} else {
			// New plugin installer
			$componentInstaller = new Installer ();
			if(!$componentInstaller->uninstall('component', $componentID)) {
				echo '<p>' . Text::_('PLG_JSPEED_ERROR_UNINSTALLING_COMPONENT') . '</p>';
			}
		}
		
		// UNINSTALL ADMIN MODULE - Check if site module exists
		$query = "SELECT extension_id" .
				 "\n FROM #__extensions" .
				 "\n WHERE type = 'module' AND element = " . $database->quote('mod_jspeed') .
				 "\n AND client_id = 1";
		$database->setQuery($query);
		$moduleID = $database->loadResult();
		if(!$moduleID) {
			echo '<p>' . Text::_('PLG_JSPEED_MODULE_ALREADY_REMOVED') . '</p>';
		} else {
			// New module installer
			$moduleInstaller = new JInstaller ();
			if(!$moduleInstaller->uninstall('module', $moduleID)) {
				echo '<p>' . Text::_('PLG_JSPEED_ERROR_UNINSTALLING_MODULE') . '</p>';
			}
		}
		
		// Uninstall complete
		return true;
	}
}