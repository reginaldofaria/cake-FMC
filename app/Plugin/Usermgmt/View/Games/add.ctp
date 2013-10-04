<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Game') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addGameForm', 'submitButtonId' => 'addGameSubmitBtn')); ?>
		<?php echo $this->Form->create('Game', array('id'=>'addGameForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Game');?></label>
			<div class="controls">
				<?php echo $this->Form->input('game', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Participant');?></label>
			<div class="controls">
				<?php echo $this->Form->input('user_id', array('label'=>false, 'div'=>false, 'class'=>'span4', 'options' => $users, 'empty' => 'Select')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Game local');?></label>
			<div class="controls">
				<?php echo $this->Form->input('local', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Game date');?></label>
			<div class="controls">
				<?php echo $this->Form->input('date', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'datepicker')); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add game', array('class'=>'btn btn-primary', 'id'=>'addGameSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>



