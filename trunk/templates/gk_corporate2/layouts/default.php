<?php

/**
 *
 * Default view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;

$this->generateColumnsWidth();

$this->addCSSRule('#gkWrap1, #gkWrap2, #gkWrap3 { width: ' . $this->getParam('template_width','980px') . '; }');

$tpl_page_suffix = '';

if($this->page_suffix != '') {
	$tpl_page_suffix = ' class="'.$this->page_suffix.'"';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <jdoc:include type="head" />
    <?php $this->loadBlock('head'); ?>
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
<body<?php echo $tpl_page_suffix; ?>>
	<?php if($this->browser->get('browser') == 'ie6' && $this->getParam('ie6bar', '1') == 1) : ?>
	<div id="gkInfobar"><a href="http://browsehappy.com"><?php echo JText::_('TPL_GK_GAVERN_IE6_BAR'); ?></a></div>
	<?php endif; ?>
	
	<?php $this->messages('message-position-1'); ?>	
	
	<div id="gkBg">   
		<div id="gkWrap1">
			<?php $this->loadBlock('nav'); ?>
			
			<?php $this->loadBlock('header'); ?>
		</div>
    </div>
    
    <?php $this->messages('message-position-2'); ?>
    
    <div id="gkWrap2">	
    	<?php $this->loadBlock('top'); ?>
    	
    	<?php $this->loadBlock('main'); ?>
    	
    	<?php $this->loadBlock('user'); ?>
    </div>
    
    <div id="gkWrap3">
    	<?php $this->loadBlock('bottom'); ?>
    	<?php $this->loadBlock('footer'); ?>
    </div>
    
    <?php $this->loadBlock('popup'); ?>
	<?php $this->loadBlock('social'); ?>
	
	<jdoc:include type="modules" name="debug" />
</body>
</html>