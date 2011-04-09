<?php

// No direct access.
defined('_JEXEC') or die;

?>

<div id="gkFooter" class="gkMain">
	<?php if($this->modules('footer_nav')) : ?>
	<div id="gkFooterNav">
		<jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" />
	</div>
	<?php endif; ?>
	
	<?php if($this->getParam('stylearea', '0') == '1') : ?>
	<p id="gkStyleArea">
		<a href="#" id="gkStyle1">Red</a>
		<a href="#" id="gkStyle2">Green</a>
		<a href="#" id="gkStyle3">Blue</a>
        <a href="#" id="gkStyle4">Neutral</a>
	</p>
	<?php endif; ?>
	
	<?php if($this->getParam('copyrights', '') !== '') : ?>
	<p id="gkCopyrights">
		<?php echo $this->getParam('copyrights', ''); ?>
	</p>
	<?php endif; ?>
	
	<?php if(isset($_COOKIE['gkGavernMobile'.JText::_('TPL_GK_CORPORATE2_NAME')]) && 
		$_COOKIE['gkGavernMobile'.JText::_('TPL_GK_CORPORATE2_NAME')] == 'desktop') : ?>
		<a href="javascript:setCookie('gkGavernMobile<?php echo JText::_('TPL_GK_CORPORATE2_NAME'); ?>', 'mobile', 365);window.location.reload();"><?php echo JText::_('TPL_GK_PENGUINMAIL_SWITCH_TO_MOBILE'); ?></a>
	<?php endif; ?>
</div>

<?php if($this->getParam('framework_logo', '0') == '1') : ?>
<div id="gkFrameworkLogo">Framework logo</div>
<?php endif; ?>