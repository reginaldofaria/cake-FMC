<div id="footer">
	<div class="container">
		<ul class="nav">
		<?php 
		echo "<li class='".(($actionUrl=='ranking') ? $activeClass : $inactiveClass)."link-ranking'>".$this->Html->link(__('home'), array('controller'=>'Frontend', 'action'=>'index'))."<span>|</span></li>
	
			  <li class='".(($actionUrl=='participe') ? $activeClass : $inactiveClass)."link-participe'>".$this->Html->link(__('participe da campanha'), array('controller'=>'Frontend', 'action'=>'participe'))."<span>|</span></li>
			  <li class='".(($actionUrl=='regulamento') ? $activeClass : $inactiveClass)."link-regulamento'>".$this->Html->link(__('regulamento'), array('controller'=>'Frontend', 'action'=>'regulamento'))."<span>|</span></li>
			  <li class='".(($actionUrl=='ranking') ? $activeClass : $inactiveClass)."link-ranking'>".$this->Html->link(__('ranking'), array('controller'=>'Frontend', 'action'=>'ranking'))."</li>"
			  
			 
			 
		?>
	</ul>
	
	
	<p>
	© COPYRIGHT 2013, FMC AGRICOLA
	</p>
	
</div>