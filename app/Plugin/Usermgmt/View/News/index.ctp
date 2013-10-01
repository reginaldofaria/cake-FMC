<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All News') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Add News', true), array('action'=>'add'));?>
			<?php echo $this->Html->link(__('Load Feed', true), array('action'=>'loadFeed'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('all_news'); ?>
	</div>
</div>

