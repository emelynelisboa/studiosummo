<?php

// Here you can modify the navigation of the website

// No direct access.
defined('_JEXEC') or die;

$logo_image = $this->getParam('logo_image', '');

if($logo_image == '') {
	$logo_image = $this->URLtemplate() . '/images/logo.png';
} else {
	$logo_image = $this->URLbase() . $logo_image;
}

$logo_text = $this->getParam('logo_text', '');
$logo_slogan = $this->getParam('logo_slogan', '');

$user = JFactory::getUser();
$userID = $user->get('id');
$btn_login_text = ($userID == 0) ? JText::_('GK_CORPORATE2_LOGIN') : JText::_('GK_CORPORATE2_ACCOUNT');

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

<div id="gkPageTop" class="gkMain <?php echo $this->generatePadding('gkPageTop'); ?>">
	
    <?php if( $this->modules('search') ): ?>
	<div id="gkSearch">
	      <jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
	</div>
	<?php endif; ?>    
    
    <?php if($this->modules('login') && $hide_popup == false) : ?>
    <a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=login" id="gkButtonLogin"><?php echo $btn_login_text; ?></a>
    <?php endif; ?>
    
    <?php if($this->getToolsOverride()) : ?>
        <a href="#" id="gkButtonTools"><?php echo JText::_('GK_CORPORATE2_TOOLS') ?></a>
    	<?php $this->loadBlock('tools/tools'); ?>
    <?php endif; ?>
</div>
<div id="gkMenuNav">
    <div id="gkMenu">
		<?php
			$this->menu->loadMenu($this->getParam('menu_name','mainmenu')); 
		    $this->menu->genMenu($this->getParam('startlevel', 0), $this->getParam('endlevel',-1));
		?>
    </div>
<?php if($this->generateSubmenu && $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1), true)): ?>
<div id="gkSubmenu">	
	<?php $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1));?>
</div>	
<?php endif; ?>
</div>
<?php if($this->getParam('logo_type', 'image') == 'image') : ?>
<h1 id="gkLogo">
	<a href="./">
	<img src="<?php echo $logo_image; ?>" alt="<?php echo $this->getPageName(); ?>" />
	</a>
</h1>
<?php elseif($this->getParam('logo_type', 'image') == 'text') : ?>
<h1 id="gkLogo" class="text">
	<a href="./">
		<?php if($this->getParam('logo_text', '') != '') : ?><span class="gkLogoText"><?php echo $this->getParam('logo_text', ''); ?></span><?php endif; ?>
		<?php if($this->getParam('logo_slogan', '') != '') : ?><span class="gkLogoSlogan"><?php echo $this->getParam('logo_slogan', ''); ?></span><?php endif; ?>
	</a>
</h1>
<?php endif; ?>