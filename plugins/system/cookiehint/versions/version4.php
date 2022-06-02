<?php
# reDim GmbH - Norbert Bayer
# Plugin: CookieHint
# license GNU/GPL   www.redim.de
# Version 1.4.0 (Joomla! 4.x)
 
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\Document\HtmlDocument;
/**
 * Class plgSystemCookieHint
 */
class plgSystemCookieHint extends CMSPlugin
{

	/**
	 * @var
	 */
	protected $app;

	/**
	 * @var
	 */
	protected $assetManager;

	/**
	 * @var
	 */
	protected $issite;

	/**
	 * @var bool
	 */
	protected $jsblocker = false;

	/**
	 * @var bool
	 */
	protected $setbottom = false;
	/**
	 * @var array
	 */
	protected $infolink = array();

	/**
	 * @var bool
	 */
	protected $_loadcode = true;

	/**
	 * plgSystemCookieHint constructor.
	 *
	 * @param $subject
	 * @param $config
	 */
	public function __construct(&$subject, $config)
	{

		parent::__construct($subject, $config);
		$this->issite = $this->app->isClient('site');

	}

	/**
	 *
	 */
	private function setNoIndex()
	{
		$this->app->getDocument()->setMetadata('robots', 'noindex, follow');
	}

	/**
	 *
	 */
	private function cleanCookies()
	{

		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-86400);
				setcookie($name, '', time()-86400, '/');
			}
		}

	}

	/**
	 *
	 */
	private function rCHredirect()
	{

		$url = $this->getURL(array('rCH' => null),false,false);
		$this->app->redirect($url,301);

	}

	/**
	 *
	 */
	public function onAfterInitialise()
	{
		if($this->issite)
		{
			if ($this->checkCookie() == false)
			{
				$this->app->getConfig()->set('caching', 0);
			}
		}
	}


	/**
	 * @return bool
	 */
	private function checkReferer() {

		if(isset($_SERVER['HTTP_REFERER'])) {
			$a=URI::getInstance()->getHost();
			$b=parse_url($_SERVER['HTTP_REFERER']);
			if(isset($b['host'])) {
				$b=$b['host'];
			}else{
				$b='';
			}
			if($a==$b) {
				return true;
			}
		}
		return false;

	}

	/**
	 *
	 */
	public function onBeforeCompileHead()
	{

		if ($this->issite == false OR $this->app->input->getCMD('tmpl') == 'component')
		{
			$this->_loadcode=false;
		}

		$ch = $this->checkCookie();

		if ($ch == 1)
		{
			return;
		}

		if ($ch == 0 OR $ch == -1)
		{
			$tmp = (int) $this->params->get('cookieblocker', '0');
			if ($tmp > 0)
			{
				@header_remove('Set-Cookie');
				if ($tmp == 2)
				{
					$tmp=trim($this->params->get('csp',"default-src 'self' 'unsafe-inline'"));
					@header('Content-Security-Policy: '.$tmp);
					@header('X-Content-Security-Policy: '.$tmp);
					@header('X-WebKit-CSP: '.$tmp);
				}
				$this->jsblocker = true;
			}
		}

		$rCH=$this->app->input->getINT('rCH');
		if($rCH<>0) {
			$this->setNoIndex();
		}

		switch ($rCH)
		{

			case -3:
			case 3:
				setcookie('reDimCookieHint', NULL, time() - 3600,'/');
				$this->rCHredirect();
				break;

			case 2:
				$d = $this->getCookieTime();
				setcookie('reDimCookieHint', 1, $d, '/');
				$this->rCHredirect();
				break;
			case -2:
				$d = $this->getCookieTime();
				#$this->cleanCookies();
				setcookie('reDimCookieHint', -1, 0, '/');
				$this->rCHredirect();
				break;

			case 1:
				$d = $this->getCookieTime();
				setcookie('reDimCookieHint', 1, $d, '/');
				echo 'ok';
				$this->app->close();
				break;
			case -1:
				$d = $this->getCookieTime();
				#$this->cleanCookies();
				setcookie('reDimCookieHint', -1, 0, '/');
				echo 'ok';
				$this->app->close();
				break;
		}

		if ($ch == 0)
		{

			$tmp      = $this->params->get('css', 'redimstyle.css');
			$wa = $this->app->getDocument()->getWebAssetManager();
			if ($tmp != '-1')
			{
				$wa->registerAndUseStyle('plg.system.cookiehint','plugins/system/cookiehint/css/' . $tmp, array('version' => 'auto', 'relative' => false));
			}

			if ($this->_get_infolink('infourl') === false OR $this->_get_infolink('imprinturl')===false)
			{
				$this->params->set('position', 'bottom');
			}

			switch ($this->params->get('position', 'bottom'))
			{

				case 'modal':
					$tmp = '#redim-cookiehint-modal {position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: 99998; display: flex; justify-content : center; align-items : center;}';
					break;

				case 'top':
					$tmp = '#redim-cookiehint-top {position: fixed; z-index: 99990; left: 0px; right: 0px; top: 0px; bottom: auto !important;}';
					break;

				default:
					$tmp = '#redim-cookiehint-bottom {position: fixed; z-index: 99999; left: 0px; right: 0px; bottom: 0px; top: auto !important;}';
					break;

			}

			$wa->addInlineStyle($tmp);
			unset($tmp);

		}

	}

	/**
	 * @return bool
	 */
	public function checkCookie()
	{

		if(!$this->issite) {
			return true;
		}

		if (defined('reDimCookieHint'))
		{
			return reDimCookieHint;
		}

		if ($this->app->input->getVAR('rCH', null) != null)
		{
			return false;
		}

		$return = false;

		if ($this->app->input->get('cookiehint') == 'set')
		{
			@setcookie('reDimCookieHint', null, -1, 0, '/');
			unset($_COOKIE['reDimCookieHint']);
		}

		if (isset($_COOKIE['reDimCookieHint']))
		{
			$return = $_COOKIE['reDimCookieHint'];
		}

		define('reDimCookieHint', $return);

		return reDimCookieHint;

	}

	/**
	 * @return float|int
	 */
	private function getCookieTime()
	{

		$cm = (int) $this->params->get('cookiemode');
		$d  = (int) $this->params->get('cookieexpires', 365);
		if ($cm == 1)
		{
			$d = 0;
		}
		else
		{
			$d = time() + ($d * 86400);
		}

		return $d;

	}

	/**
	 *
	 */
	public function onAfterRender()
	{

		$set    = false;
		$buffer = $this->app->getBody();
		if ($this->jsblocker == true)
		{
			$html = "\n" . '<script type="text/javascript">' . $this->getHeadJava(true, true, true) . '</script>' . "\n";
			if ($buffer = preg_replace("/\<head(.*)>/", "\n$0" . $html . "\n", $buffer, 1))
			{
				$set = true;
			}
		}

		if ($this->checkCookie() != true AND $this->_loadcode===true)
		{
			$html = $this->_get_code();
			if ($buffer = preg_replace("/\<\/body(.*)>/", "\n" . $html . "\n$0", $buffer))
			{
				$set = true;
			}
		}

		if ($set == true)
		{
			$this->app->setBody($buffer);
		}

	}

	/**
	 * @param int $disableCookies
	 * @param int $disableLocal
	 * @param int $disableSession
	 *
	 * @return array|false|string|string[]
	 */
	private function getHeadJava($disableCookies = 1, $disableLocal = 1, $disableSession = 1)
	{
		ob_start();
		?>
		(function(){
		function blockCookies(disableCookies, disableLocal, disableSession){
		if(disableCookies == 1){
		if(!document.__defineGetter__){
		Object.defineProperty(document, 'cookie',{
		get: function(){ return ''; },
		set: function(){ return true;}
		});
		}else{
		var oldSetter = document.__lookupSetter__('cookie');
		if(oldSetter) {
		Object.defineProperty(document, 'cookie', {
		get: function(){ return ''; },
		set: function(v){
		if(v.match(/reDimCookieHint\=/)) {
		oldSetter.call(document, v);
		}
		return true;
		}
		});
		}
		}
		var cookies = document.cookie.split(';');
		for (var i = 0; i < cookies.length; i++) {
		var cookie = cookies[i];
		var pos = cookie.indexOf('=');
		var name = '';
		if(pos > -1){
		name = cookie.substr(0, pos);
		}else{
		name = cookie;
		}
		if(name.match(/reDimCookieHint/)) {
		document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
		}
		}
		}
		if(disableLocal == 1){
		window.localStorage.clear();
		window.localStorage.__proto__ = Object.create(window.Storage.prototype);
		window.localStorage.__proto__.setItem = function(){ return undefined; };
		}
		if(disableSession == 1){
		window.sessionStorage.clear();
		window.sessionStorage.__proto__ = Object.create(window.Storage.prototype);
		window.sessionStorage.__proto__.setItem = function(){ return undefined; };
		}
		}
		blockCookies(<?PHP echo $disableCookies; ?>,<?PHP echo $disableLocal; ?>,<?PHP echo $disableSession; ?>);
		}());
		<?PHP
		return str_replace(array("\n", "\r", "\t", "    "), ' ', ob_get_clean());

	}

	/**
	 * @param array $ar
	 * @param false $url
	 * @param bool  $chars
	 *
	 * @return string
	 */
	private function getURL($ar = array(), $url = false,$chars=true)
	{

		if ($url)
		{
			$uri = URI::getInstance($url);
		}
		else
		{
			$uri = URI::getInstance();
		}

		$q = $uri->getQuery(true);

		if (count($ar) > 0)
		{
			if(isset($q['cookiehint'])) {
				unset($q['cookiehint']);
			}
			$q = array_merge($q, $ar);
		}

		$uri->setQuery($q);

		if($chars==false) {
			return $uri->toString();
		}

		return htmlspecialchars($uri->toString(),ENT_COMPAT, 'UTF-8');

	}

	/**
	 * @param mixed $app
	 */
	public function setApp($app)
	{
		$this->app = $app;
	}

	/**
	 * @param mixed $assetManager
	 */
	public function setAssetManager($assetManager)
	{
		$this->assetManager = $assetManager;
	}

	/**
	 * @param mixed $issite
	 */
	public function setIssite($issite)
	{
		$this->issite = $issite;
	}

	/**
	 * @param bool $jsblocker
	 */
	public function setJsblocker($jsblocker)
	{
		$this->jsblocker = $jsblocker;
	}

	/**
	 * @param bool $setbottom
	 */
	public function setSetbottom($setbottom)
	{
		$this->setbottom = $setbottom;
	}

	/**
	 * @param array $infolink
	 */
	public function setInfolink($infolink)
	{
		$this->infolink = $infolink;
	}

	/**
	 * @param bool $loadcode
	 */
	public function setLoadcode($loadcode)
	{
		$this->_loadcode = $loadcode;
	}

	/**
	 * @return string
	 */
	public function onPageCacheGetKey()
	{

		$x = 0;
		if (isset($_COOKIE['reDimCookieHint']))
		{
			$x = $_COOKIE['reDimCookieHint'];
		}

		return 'reDimCookieHint' . $x;

	}

	/**
	 * @return array|false|string|string[]
	 */
	private function _get_code()
	{

		$link           = $this->_get_infolink('infourl');
		$linkimprint  = $this->_get_infolink('imprinturl');

		$linkok         = $this->getURL(array('rCH' => 2));
		$linknotok      = $this->getURL(array('rCH' => -2));
		$position       = $this->params->get('position', 'bottom');

		$refusal = (int) $this->params->get('refusal');

		if ($refusal == 2)
		{
			$refusalurl = trim((string) $this->params->get('refusalurl', 'https://www.cookieinfo.org/'));
			/*if(empty($refusalurl)) {
				$refusalurl = $this->getURL(array('reDimCookieHint'=>-1));
			}*/
		}
		else
		{
			$refusalurl = '';
		}

		ob_start();
		$file = str_replace('/', '', $this->params->get('file', 'redimstyle.php'));

		$l = $this->app->getLanguage()->getTag();
		$temp = $l . '_' . $file;

		if (file_Exists(JPATH_SITE . '/plugins/system/cookiehint/include/' . $temp))
		{
			$file = $temp;
		}
		else
		{
			if (!file_exists(JPATH_SITE . '/plugins/system/cookiehint/include/' . $file))
			{
				$file = 'default.php';
			}
		}

		include_once(JPATH_SITE . '/plugins/system/cookiehint/include/' . $file);

		?>
		<script type="text/javascript">

            document.addEventListener("DOMContentLoaded", function(event) {
                if (!navigator.cookieEnabled){
                    document.getElementById('redim-cookiehint-<?PHP echo $position; ?>').remove();
                }
            });

            function cookiehintfadeOut(el) {
                el.style.opacity = 1;
                (function fade() {
                    if ((el.style.opacity -= .1) < 0) {
                        el.style.display = "none";
                    } else {
                        requestAnimationFrame(fade);
                    }
                })();
            }
			<?PHP
			if ($this->params->get('cookiemode') == 0)
			{
				$d = (int) $this->params->get('cookieexpires', 365);
				$c = date('D, d M Y', time() + (86400 * $d)) . ' 23:59:59 GMT;';
				$c = 'reDimCookieHint=%s; expires=' . $c;
			}
			else
			{
				$c = 'reDimCookieHint=%s; expires=0;';
			}
			?>
            function cookiehintsubmit(obj) {
                document.cookie = '<?PHP echo printf($c, 1); ?>; path=/';
                cookiehintfadeOut(document.getElementById('redim-cookiehint-<?PHP echo $position;?>'));
                return true;
            }

            function cookiehintsubmitno(obj) {
                document.cookie = 'reDimCookieHint=-1; expires=0; path=/';
                cookiehintfadeOut(document.getElementById('redim-cookiehint-<?PHP echo $position;?>'));
                return true;
            }
		</script>
		<?PHP
		return str_replace(array("\n", "\r", "\t", "  "), ' ', ob_get_clean());
	}

	/**
	 * @param string $name
	 *
	 * @return false|mixed
	 */
	private function _get_infolink($name='infourl')
	{

		if(isset($this->infolink[$name])) {
			return $this->infolink[$name];
		}

		$lang = $this->app->getLanguage();
		$lang->load("plg_system_cookiehint", JPATH_ADMINISTRATOR);

		$l = $lang->getTag();

		$link  = false;
		$links = $this->params->get($name, array());
		if (is_object($links))
		{
			$links = (array) $links;
		}
		if (is_array($links))
		{
			if (isset($links[$l]))
			{
				if (!empty($links[$l]))
				{
					$link = $links[$l];
				}
			}
			if (empty($link))
			{
				if (count($links) > 0)
				{
					foreach ($links as $link)
					{
						if (!empty($link))
						{
							break;
						}
					}
				}
			}
		}
		unset($links);

		$url = URI::getInstance()->toString(array('path', 'query', 'fragment'));
		if ($link)
		{
			if ($url == $link OR $url == '/' . $link)
			{
				if (!empty($link))
				{
					$link = false;
				}
			}
		}

		$this->infolink[$name]=$link;

		return $link;

	}

}
