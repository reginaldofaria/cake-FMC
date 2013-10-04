<div class="side-bar">
	<div class="contador">
	<script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				$('#countdown_dashboard').countDown({
					targetDate: {
						'day': 		12,
						'month': 	6,
						'year': 	2014,
						'hour': 	17,
						'min': 		0,
						'sec': 		0
					}
				});
				
	
			});
		</script>
	

  
	
	<div id="countdown_dashboard">
        	<div class="dash days_dash">
				
				<div class="digit">0</div>
				<div class="digit">0</div>
                <div class="digit">0</div>
				<span class="dash_title">dias</span>
			</div>
		</div>
	
	
	
	</div>
	
	<div class="tabela">
	
	<?php echo $this->Html->link(__('tabela'), array('controller'=>'Frontend', 'action'=>'tabela'))  ?>
	
	
	
	</div>




</div>