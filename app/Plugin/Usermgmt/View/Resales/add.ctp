<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Resale') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addResaleForm', 'submitButtonId' => 'addResaleSubmitBtn')); ?>
		<?php echo $this->Form->create('Resale', array('id'=>'addResaleForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Resale Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('name', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Resale Code');?></label>
			<div class="controls">
				<?php echo $this->Form->input('code', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add Resale', array('class'=>'btn btn-primary', 'id'=>'addResaleSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>



