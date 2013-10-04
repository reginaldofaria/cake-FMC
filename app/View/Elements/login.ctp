<div class="row">
<?php echo $this->Html->image('aba-form.png', array('alt' => 'Fmc')); ?>
	<div class="um-panel span6 offset3">
		<div class="um-panel-content">
			<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'loginForm', 'submitButtonId' => 'loginSubmitBtn')); ?>
			<?php echo $this->Form->create('User', array('id'=>'loginForm', 'class'=>'', 'url' => array('controller' => 'frontend', 'action' => 'login'))); ?>
			<div class="um-form-row control-group">
				<h2><?php echo __('Login');?></h2>
				<div class="controls">
					<?php echo $this->Form->input('email', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Email'))); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<?php /*?><label class="control-label required"><?php echo __('Senha');?></label><?php */?>
				<div class="controls">
					<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Senha'))); ?>
				</div>
			</div>
			
			<?php if($this->UserAuth->canUseRecaptha('login')) { ?>
			<div class="um-form-row control-group">
				<?php   $this->Form->unlockField('recaptcha_challenge_field');
						$this->Form->unlockField('recaptcha_response_field'); ?>
				<label class="control-label required"><?php echo __('Prove you\'re not a robot');?></label>
			</div>
			<?php } ?>
			<div class="um-button-row">
            	<?php echo $this->Html->link(__('Esqueceu sua senha?'), '/forgotPassword', array('class'=>'right btn')); ?>
				<?php echo $this->Form->Submit('Login', array('div'=>false, 'class'=>'btn btn-primary', 'id'=>'loginSubmitBtn')); ?>
				
			</div>
			<?php echo $this->Form->end(); ?>
			<?php echo $this->element('Usermgmt.provider'); ?>
		</div>
	</div>
    
</div>