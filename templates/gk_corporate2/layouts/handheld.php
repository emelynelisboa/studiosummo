<?php

/**
 *
 * Handheld view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <jdoc:include type="head" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <?php $this->loadBlock('mobile' . DS . 'head.handheld'); ?>
    <script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22284115-2']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>	
</head>
<body>
    <div id="gkWrap">
    	<div id="gkTopWrap">
    		<h1 id="gkHeader">
    			<a href="./"><?php echo $this->getPageName(); ?></a>	
    		</h1>
    	
    		<?php if($this->getParam('mobile_desktop', 0) == '1') : ?>
    		<a href="#" id="gk-btn-switch" ><span><?php echo JText::_('TPL_GK_CORPORATE2_GK_MOBILE_DESKTOP'); ?></span></a>
    		<?php endif; ?>
    		
    		<?php if($this->getParam('mobile_register', 0) == '1') : ?>
    		<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&view=registration" id="gk-btn-register" ><span><?php echo JText::_('TPL_GK_CORPORATE2_GK_MOBILE_REGISTER'); ?></span></a>
    		<?php endif; ?>
    		
    		<?php if($this->getParam('mobile_login', 0) == '1') : ?>
    		<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=login" id="gk-btn-login" ><span><?php echo JText::_('TPL_GK_CORPORATE2_GK_MOBILE_LOGIN'); ?></span></a>
    		<?php endif; ?>
    	</div>
    	
    	<div id="gkNav">
    		<div id="gkNavContent">
    			<select id="gkMenu" onchange="window.location.href=this.value;">
    			<?php
    				$this->menu->loadMenu($this->getParam('mobile_menu_name','mainmenu')); 
    			    $this->menu->genMenu(0, -1);
    			?>
    			</select>
    		</div>
    	</div>

		<?php if($this->getParam('mobile_search', 0) == '1') : ?>
		<div id="gkSearch">
			<form method="post" action="index.php">
				<p>
					<input type="text" class="inputbox" id="mod-search-searchword" name="searchword">
					<input type="submit" id="gk-btn-search" class="button" value="<?php echo JText::_('TPL_GK_CORPORATE2_GK_MOBILE_SEARCH'); ?>">	
					<input type="hidden" value="search" name="task">
					<input type="hidden" value="com_search" name="option">
					<input type="hidden" value="435" name="Itemid">
				</p>
			</form>
		</div>
		<?php endif; ?>
    	
    	<div id="gkContent">
	    	<?php if($this->modules('mobile_top')) : ?>
	    	<div id="gkTop">
	    		<jdoc:include type="modules" name="mobile_top" style="gk_mobile" />
	    	</div>
	    	<?php endif; ?>
	    	
	    	<div id="gkMain">
	    		<jdoc:include type="message" />
	    		<jdoc:include type="component" />
	    	</div>
	    	
	    	<?php if($this->modules('mobile_bottom')) : ?>
	    	<div id="gkBottom">
	    		<jdoc:include type="modules" name="mobile_bottom" style="gk_mobile" />
	    	</div>
	    	<?php endif; ?>
	 
	    	<div id="gkFooter">
	    		<p id="gkCopyrights"><?php echo $this->getParam('copyrights', ''); ?></p>
	    		
	    		<p id="gkOptions">
	    			<a href="#gkHeader"><?php echo JText::_('TPL_GK_CORPORATE2_MOBILE_TOP'); ?></a>
	    			<a href="javascript:setCookie('gkGavernMobile<?php echo JText::_('TPL_GK_CORPORATE2_NAME'); ?>', 'desktop', 365);window.location.reload();"><?php echo JText::_('TPL_GK_CORPORATE2_MOBILE_SWITCH_DESKTOP'); ?></a>
	    		</p>
	    	</div>
    	</div>
	</div>
	
	<?php 
		// put Google Analytics code
		$this->googleAnalyticsParser(); 
	?>
</body>
</html>