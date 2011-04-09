<?php

// No direct access.
defined('_JEXEC') or die;

//
$hide_popup = false;
// check if the page is a login page
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
//
if($option == 'com_users' && $view == 'login') {
    $hide_popup = true;
}

?>

<?php if($this->modules('login') && $hide_popup == false) : ?>
<div class="gkPopup" id="popupLogin">
	<div class="gkPopupWrap">        
		<jdoc:include type="modules" name="login" style="<?php echo $this->module_styles['login']; ?>" />
  	</div>
</div>
<?php endif; ?>