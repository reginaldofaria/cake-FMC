 <!DOCTYPE html>
	<html lang="pt-BR">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Sistema CMS - Mgb Mob</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script language="javascript">
			var urlForJs="<?php echo SITE_URL ?>";
		</script>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css('frontend.css?q='.QRDN);
			echo $this->Html->script('jquery-1.10.2.min.js');
			echo $this->Html->script('bootstrap.js?q='.QRDN);
			echo $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js?q='.QRDN);
			echo $this->Html->script('/plugins/bootstrap-ajax-typeahead/js/bootstrap-typeahead.min.js?q='.QRDN);
			echo $this->Html->script('/plugins/chosen/chosen.jquery.min.js?q='.QRDN);
			/* Usermgmt Plugin JS */
			echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);
			echo $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN);
			echo $this->Html->script('/usermgmt/js/chosen/chosen.ajaxaddition.jquery.js?q='.QRDN);

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<?php echo $this->element('menu_sup'); ?>
				<?php echo $this->element('Usermgmt.message'); ?>
				<?php echo $this->element('Usermgmt.message_validation'); ?>
				<?php echo $this->fetch('content'); ?>
				<div style="clear:both"></div>
			</div>
		</div>
		<?php echo $this->element('footer'); ?>
		<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) { echo $this->Js->writeBuffer(); } ?>
	</body>
	</html>