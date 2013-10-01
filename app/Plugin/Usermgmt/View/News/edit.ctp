<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit News') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editNewsForm', 'submitButtonId' => 'editNewsSubmitBtn')); ?>
		<?php echo $this->Form->create('News', array('type' => 'file', 'id'=>'editNewsForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('title');?></label>
			<div class="controls">
				<?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'class' => 'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Active');?></label>
			<div class="controls">
				<?php echo $this->Form->input('active', array('type'=>'checkbox', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('News Content');?></label>
			<div class="controls">
				<?php  echo $this->Tinymce->textarea('News.content', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px', 'class'=>'span10'), array('language'=>'pt_BR'), 'umcode');?>
			</div>
		</div>
		<?php if(!empty($this->request->data['News']['image'])){?>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Registered image');?></label>
			<div class="controls">
					<img alt="" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $this->request->data['News']['image'], 250, null, true) ?>">
					<?php echo $this->Form->input('image_registered', array('label'=>false, 'div'=>false, 'type' => 'hidden', 'value' => $this->request->data['News']['image'])); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Remove image');?></label>
			<div class="controls">
				<?php echo $this->Form->input('remove_image', array('type'=>'checkbox', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<?php }?>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Image');?></label>
			<div class="controls">
				<?php echo $this->Form->input('image', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update News', array('class'=>'btn btn-primary', 'id'=>'editNewsSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
