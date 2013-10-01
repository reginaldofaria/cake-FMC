<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Sale') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editSaleForm', 'submitButtonId' => 'editSaleSubmitBtn')); ?>
		<?php echo $this->Form->create('Sale', array('id'=>'editSaleForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Participant');?></label>
			<div class="controls">
				<?php echo $this->Form->input('user_id', array('label'=>false, 'div'=>false, 'class'=>'span4', 'options' => $users, 'empty' => 'Select')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Product');?></label>
			<div class="controls">
				<?php echo $this->Form->input('product_id', array('label'=>false, 'div'=>false, 'class'=>'span4', 'options' => $products, 'empty' => 'Select')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Litros/hectares');?></label>
			<div class="controls">
				<?php echo $this->Form->input('litros_hectares', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'')); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update Sale', array('class'=>'btn btn-primary', 'id'=>'editSaleSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
