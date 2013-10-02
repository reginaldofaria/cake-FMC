<div class="pagination pagination-right">
	<ul>
		<?php
		$firstP=$this->Paginator->first(__('Primeiro'), array('tag' => 'li'));
		if(!empty($firstP)) {
			echo $firstP;
		} else {
			echo "<li class='disabled'><span>Primeiro</span></li>";
		}
		if($this->Paginator->hasPrev()) {
			echo $this->Paginator->prev(__('<<'), array('tag' => 'li'));;
		} else {
			echo "<li class='disabled'><span><<</span></li>";
		}
		echo $this->Paginator->numbers(array('separator'=>'', 'tag' => 'li', 'currentTag'=>'span'));
		if($this->Paginator->hasNext()) {
			echo $this->Paginator->next(__('>>'), array('tag' => 'li'));;
		} else {
			echo "<li class='disabled'><span>Next</span></li>";
		}
		$lastP=$this->Paginator->last(__('>>'), array('tag' => 'li'));
		if(!empty($lastP)) {
			echo $lastP;
		} else {
			echo "<li class='disabled'><span>Último</span></li>";
		}
		
		echo "<li><span style='padding-top: 3px;height:21px;width:21px'>".$this->Html->image(SITE_URL.'usermgmt/img/loading-circle.gif', array('id' => 'busy-indicator', 'style'=>'display:none;'))."</span></li>";
		?>
	</ul>
</div>
<?php echo $this->Js->writeBuffer();  ?>