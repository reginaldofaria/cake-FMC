<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All Game') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Add Game', true), array('action'=>'add'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('all_games'); ?>
	</div>
</div>

