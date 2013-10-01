<?php 
if(!$this->UserAuth->isLogged()) {
	echo $this->element('login');
}
else {
	echo "Ola " . $var['User']['first_name'];
	echo $this->Html->link(__('Logout'), array('controller'=>'Frontend', 'action'=>'logout'))
}
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>
	<ul>
		<?php 
		echo "<li class='".(($actionUrl=='participe') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('participe'), array('controller'=>'Frontend', 'action'=>'participe'))."</li>
			  <li class='".(($actionUrl=='regulamento') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('regulamento'), array('controller'=>'Frontend', 'action'=>'regulamento'))."</li>
			  <li class='".(($actionUrl=='ranking') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('ranking'), array('controller'=>'Frontend', 'action'=>'ranking'))."</li>
			  <li class='".(($actionUrl=='home') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Home'), array('controller'=>'Frontend', 'action'=>'index'))."</li>";
		?>
	</ul>