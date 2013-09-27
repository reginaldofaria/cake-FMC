<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add News') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addNewsForm', 'submitButtonId' => 'addNewsSubmitBtn')); ?>
		<?php echo $this->Form->create('News', array('type' => 'file', 'id'=>'addNewsForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('News Title');?></label>
			<div class="controls">
				<?php echo $this->Form->input('title', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Image');?></label>
			<div class="controls">
				<?php echo $this->Form->input('News.image', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('News Content');?></label>
			<div class="controls">
				<?php  echo $this->Tinymce->textarea('News.content', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px', 'class'=>'span10'), array('language'=>'pt_BR'), 'umcode');?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add News', array('class'=>'btn btn-primary', 'id'=>'addNewsSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>



