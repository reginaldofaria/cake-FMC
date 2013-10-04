<div class="row">
	<div class="um-panel span6 offset3">
		<div class="um-panel-content">
			<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'loginForm', 'submitButtonId' => 'loginSubmitBtn')); ?>
			<?php echo $this->Form->create('User', array('id'=>'loginForm', 'class'=>'', 'url' => array('controller' => 'frontend', 'action' => 'entrar'))); ?>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Email / Username');?></label>
				<div class="controls">
					<?php echo $this->Form->input('email', array('type'=>'text', 'label'=>false, 'div'=>false, 'placeholder'=>__('Email'))); ?>
				</div>
			</div>
			<div class="um-form-row control-group">
				<label class="control-label required"><?php echo __('Senha');?></label>
				<div class="controls">
					<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false, 'placeholder'=>__('Senha'))); ?>
				</div>
			</div>
			<?php if(USE_REMEMBER_ME) { ?>
			<div class="um-form-row control-group">
			<?php   if(!isset($this->request->data['User']['remember'])) {
						$this->request->data['User']['remember']=true;
					} ?>
				<label class="control-label"><?php echo __('Remember me');?></label>
				<div class="controls">
					<?php echo $this->Form->input('remember', array('type'=>'checkbox', 'label'=>false, 'div'=>false)); ?>
				</div>
			</div>
			<?php } ?>
			<div class="um-button-row">
				<?php echo $this->Form->Submit('Sign In', array('div'=>false, 'class'=>'btn btn-primary', 'id'=>'loginSubmitBtn')); ?>
				<?php echo $this->Html->link(__('Forgot Password?'), '/forgotPassword', array('class'=>'right btn')); ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>