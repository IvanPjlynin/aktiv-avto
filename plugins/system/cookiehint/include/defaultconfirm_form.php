<?PHP
# reDim GmbH - Norbert Bayer
# Plugin: CookieHint
# license GNU/GPL   www.redim.de

// No direct access
defined('JPATH_BASE') or die;
$notxt = addslashes(JText::_('PLG_SYSTEM_COOKIEHINT_REALLY_NO'));

?>
<script type="text/javascript">
    function cookiehintsubmitnoc(obj) {
        if (confirm("<?PHP echo $notxt;?>")) {
            document.cookie = 'reDimCookieHint=-1; expires=0; path=/';
            cookiehintfadeOut(document.getElementById('redim-cookiehint-<?PHP echo $position;?>'));
            return true;
        } else {
            return false;
        }
    }
</script>
<div id="redim-cookiehint-<?PHP echo $position; ?>">
    <div id="redim-cookiehint">
        <div class="cookiecontent">
			<?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_INFO'); ?>
        </div>
        <div class="cookiebuttons">
            <form class="reset" method="post">
                <button id="cookiehintsubmit" onclick="return cookiehintsubmit(this);" data-href="<?PHP echo $linkok; ?>"
                        type="submit" name="rCH" value="2"
                        class="btn"><?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_BTN_OK'); ?></button>
		        <?PHP if ($refusal == 2): ?>
			        <?PHP if (!empty($refusalurl)): ?>
                        <button id="cookiehintsubmitno" data-href="<?PHP echo $refusalurl; ?>"
                                type="submit" name="rCH" value="-2"
                                class="btn"><?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_BTN_NOTOK'); ?></button>
			        <?PHP endif; ?>
		        <?PHP elseif ($refusal == 1): ?>
                    <button id="cookiehintsubmitno" onclick="return cookiehintsubmitnoc(this);" data-href="<?PHP echo $linknotok; ?>"
                            type="submit" name="rCH" value="-2"
                            class="btn"><?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_BTN_NOTOK'); ?></button>
		        <?PHP endif; ?>
                <div class="text-center" id="cookiehintinfo">
			        <?PHP if(!empty($link)): ?>
                        <a target="_self" href="<?PHP echo $link; ?>"><?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_BTN_INFO'); ?></a>
			        <?PHP endif; ?>
			        <?PHP if(!empty($linkimprint)): ?>
                        <a target="_self" href="<?PHP echo $linkimprint;?>"><?PHP echo JText::_('PLG_SYSTEM_COOKIEHINT_BTN_IMPRINT'); ?></a>
			        <?PHP endif; ?>
                </div>
            </form>
        </div>
        <div class="clr"></div>
    </div>
</div>
