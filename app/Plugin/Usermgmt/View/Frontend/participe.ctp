<div class="um-panel-content">
	<div class="row">
		<div class="span6">
			<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'registerForm', 'submitButtonId' => 'registerSubmitBtn')); ?>
			<?php echo $this->Form->create('User', array('type' => 'file', 'id'=>'registerForm', 'class'=>'', 'url' => array('controller' => 'frontend', 'action' => 'participe'))); ?>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Nome');?></label>
				<div class="controls">
					<?php echo $this->Form->input('first_name', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Email');?></label>
				<div class="controls">
					<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Revenda');?></label>
				<div class="controls">
					<?php echo $this->Form->input('resale_id', array('label'=>false, 'div'=>false, 'class'=>'span4', 'options' => $resales, 'empty' => 'Select')); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Cidade');?></label>
				<div class="controls">
					<?php echo $this->Form->input('UserDetail.city', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Endereço');?></label>
				<div class="controls">
					<?php echo $this->Form->input('UserDetail.location', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Telefone');?></label>
				<div class="controls">
					<?php echo $this->Form->input('UserDetail.cellphone', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label"><?php echo __('Foto');?></label>
				<div class="controls">
					<?php echo $this->Form->input('UserDetail.photo', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Código');?></label>
				<div class="controls">
					<?php echo $this->Form->input('Resale.code', array('label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Senha');?></label>
				<div class="controls">
					<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Confirmar senha');?></label>
				<div class="controls">
					<?php echo $this->Form->input('cpassword', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<div class="um-button-row">
				<?php echo $this->Form->Reset('Limpar', array('div'=>false, 'class'=>'', 'id'=>'')); ?>
				<?php echo $this->Form->Submit('Enviar', array('div'=>false, 'class'=>'', 'id'=>'registerSubmitBtn')); ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>		
	</div>
</div>