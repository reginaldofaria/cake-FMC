<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Sale') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addSaleForm', 'submitButtonId' => 'addSaleSubmitBtn')); ?>
		<?php echo $this->Form->create('Sale', array('id'=>'addSaleForm', 'class'=>'form-horizontal')); ?>
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
			<?php echo $this->Form->Submit('Add Sale', array('class'=>'btn btn-primary', 'id'=>'addSaleSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>



