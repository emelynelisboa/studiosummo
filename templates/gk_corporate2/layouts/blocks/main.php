<?php

// No direct access.
defined('_JEXEC') or die;

?>

<?php if($this->mainExists('all')) : ?>
<div id="gkMain">
	<div id="gkMainBlock" class="gkMain">
		<?php $this->loadBlock('left'); ?>
	
		<?php if($this->mainExists('content')) : ?>
		<div id="gkContent" class="gkMain gkCol <?php echo $this->generatePadding('gkContentColumn'); ?>">
			<?php if($this->modules('top')) : ?>
			<div id="gkContentTop" class="gkMain <?php echo $this->generatePadding('gkContentTop'); ?>">
				<jdoc:include type="modules" name="top" style="<?php echo $this->module_styles['top']; ?>" />
			</div>
			<?php endif; ?>
			
			<?php if($this->mainExists('content_mainbody')) : ?>
			<div id="gkContentMainbody" class="gkMain <?php echo $this->generatePadding('gkContentMainbody'); ?>">
				<?php if($this->modules('inset1')) : ?>
				<div id="gkInset1" class="gkMain gkCol <?php echo $this->generatePadding('gkInset1'); ?>">
					<jdoc:include type="modules" name="inset1" style="<?php echo $this->module_styles['inset1']; ?>" />
				</div>
				<?php endif; ?>			
				
				<?php if($this->mainExists('component_wrap')) : ?>
					<?php 
						$is_column = ($this->modules('inset1 + inset2')) ? 'gkCol' : '';
					?>
					
				<div id="gkComponentWrap" class="gkMain <?php echo $is_column; ?> <?php echo $this->generatePadding('gkComponentWrap'); ?>">	
					<?php if($this->modules('mainbody_top')) : ?>
					<div id="gkMainbodyTop" class="gkMain <?php echo $this->generatePadding('gkMainbodyTop'); ?>">
						<jdoc:include type="modules" name="mainbody_top" style="<?php echo $this->module_styles['mainbody_top']; ?>" />
					</div>
					<?php endif; ?>	
					
					<?php $this->messages('message-position-3'); ?>
					
					<?php if($this->mainExists('component')) : ?>
					<div id="gkMainbody" class="gkMain <?php echo $this->generatePadding('gkMainbody'); ?>">						
						<?php if($this->isFrontpage()) : ?>
							<?php if($this->getParam('mainbody_frontpage', 'only_component') == 'only_component') : ?>	
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<?php elseif($this->getParam('mainbody_frontpage', 'only_component') == 'only_mainbody') : ?>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
							<?php elseif($this->getParam('mainbody_frontpage', 'only_component') == 'mainbody_before_component') : ?>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<?php else : ?>
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
							<?php endif; ?>
						<?php else : ?>
							<?php if($this->getParam('mainbody_subpage', 'only_component') == 'only_component') : ?>	
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<?php elseif($this->getParam('mainbody_subpage', 'only_component') == 'mainbody_before_component') : ?>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<?php else : ?>
							<div id="gkComponent">
								<jdoc:include type="component" />
							</div>
							<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
							<?php endif; ?>					
						<?php endif; ?>
					</div>
					<?php endif; ?>
					
					<?php if($this->modules('mainbody_bottom')) : ?>
					<div id="gkMainbodyBottom" class="gkMain <?php echo $this->generatePadding('gkMainbodyBottom'); ?>">
						<jdoc:include type="modules" name="mainbody_bottom" style="<?php echo $this->module_styles['mainbody_bottom']; ?>" />
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
					
				<?php if($this->modules('inset2')) : ?>
				<div id="gkInset2" class="gkMain gkCol <?php echo $this->generatePadding('gkInset2'); ?>">
					<jdoc:include type="modules" name="inset2" style="<?php echo $this->module_styles['inset2']; ?>" />
				</div>
				<?php endif; ?>	
			</div>
			<?php endif; ?>
			
			<?php if($this->modules('bottom')) : ?>
			<div id="gkContentBottom" class="gkMain <?php echo $this->generatePadding('gkContentBottom'); ?>">
				<jdoc:include type="modules" name="bottom" style="<?php echo $this->module_styles['bottom']; ?>" />
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	
		<?php $this->loadBlock('right'); ?>
	</div>
</div>
<?php endif; ?>