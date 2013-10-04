<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Game') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editGameForm', 'submitButtonId' => 'editGameSubmitBtn')); ?>
		<?php echo $this->Form->create('Game', array('id'=>'editGameForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('game');?></label>
			<div class="controls">
				<?php echo $this->Form->input('game', array('label'=>false, 'div'=>false, 'class' => 'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Participant');?></label>
			<div class="controls">
				<?php echo $this->Form->input('Game.user_id', array('label'=>false, 'div'=>false, 'type' => 'select', 'options'=>$users)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Local');?></label>
			<div class="controls">
				<?php echo $this->Form->input('local', array('label'=>false, 'div'=>false, 'class' => 'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Date');?></label>
			<div class="controls">
				<?php echo $this->Form->input('date', array('type' => 'text', 'label'=>false, 'div'=>false, 'class' => 'datepicker', 'value' => date('d/m/Y',strtotime($this->request->data['Game']['date'])))); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update Game', array('class'=>'btn btn-primary', 'id'=>'editGameSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
