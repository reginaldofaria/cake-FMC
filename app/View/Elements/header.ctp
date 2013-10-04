<header>
<h1><?php echo $this->Html->link(__('home'), array('controller'=>'Frontend', 'action'=>'index')) ?></h1>




<?php 
if(!$this->UserAuth->isLogged()) {
	echo $this->element('login');
}
else {
	echo "Ola " . $var['User']['first_name'];
	echo $this->Html->link(__('Logout'), array('controller'=>'Frontend', 'action'=>'logout'));
}
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>
	<ul class="nav">
		<?php 
		echo "<li class='".(($actionUrl=='participe') ? $activeClass : $inactiveClass)."link-participe'>".$this->Html->link(__('participe da campanha'), array('controller'=>'Frontend', 'action'=>'participe'))."</li>
			  <li class='".(($actionUrl=='regulamento') ? $activeClass : $inactiveClass)."link-regulamento'>".$this->Html->link(__('regulamento'), array('controller'=>'Frontend', 'action'=>'regulamento'))."</li>
			  <li class='".(($actionUrl=='ranking') ? $activeClass : $inactiveClass)."link-ranking'>".$this->Html->link(__('ranking'), array('controller'=>'Frontend', 'action'=>'ranking'))."</li>
			  
			  <li class='link-fmc'> ".$this->Html->image('logo-fmc.jpg', array('alt' => 'Fmc'));" </li>" 
			 
		?>
	</ul>
    
</header>