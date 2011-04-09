<?php

// No direct access.
defined('_JEXEC') or die;
$header_1_4_columns = $this->generateColumnsBlock(6, 'header', 'header1_4', 1);
?>

<?php if( $this->modules('banner1')) : ?>
<div id="gkBanner1" class="clear clearfix">
      <jdoc:include type="modules" name="banner1" style="<?php echo $this->module_styles['banner1']; ?>" />
</div>
<?php endif; ?>

<?php if($this->modules('header') || $this->modules('header1 + header2 + header3 + header4')) : ?>
<div id="gkHeader" class="gkMain">
    <?php if($this->modules('header1 + header2 + header3 + header4')) : ?>
<div id="gkHeaderModules" class="gkMain <?php echo $this->generatePadding('gkTop1'); ?>">
	<?php foreach($header_1_4_columns as $column) : ?>
	<?php if($column !== null) : ?>	
	<div id="gkHeader<?php echo $column['name']; ?>" class="gkCol <?php echo $column['class']; ?>">
		<?php $this->addCSSRule('#gkHeader'.$column['name'].' { width: ' . $column['width'] . '%; }'); ?>
		<jdoc:include type="modules" name="<?php echo $column['name']; ?>" style="<?php echo $this->module_styles[$column['name']]; ?>" />
	</div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
                
	<?php if($this->modules('header')) : ?>
	<div id="gkHeaderModule">
		<jdoc:include type="modules" name="header" style="<?php echo $this->module_styles['header']; ?>" />
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>





<?php if( $this->modules('banner2')) : ?>
<div id="gkBanner2" class="clear clearfix">
      <jdoc:include type="modules" name="banner2" style="<?php echo $this->module_styles['banner2']; ?>" />
</div>
<?php endif; ?>