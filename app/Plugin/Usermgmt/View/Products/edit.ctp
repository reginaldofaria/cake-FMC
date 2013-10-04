<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Product') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editProductForm', 'submitButtonId' => 'editProductSubmitBtn')); ?>
		<?php echo $this->Form->create('Product', array('id'=>'editProductForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Product Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('name', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Edit Product', array('class'=>'btn btn-primary', 'id'=>'editProductSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>



