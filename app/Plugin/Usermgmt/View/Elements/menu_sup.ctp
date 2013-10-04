<?php 
if(!$this->UserAuth->isLogged()) {
	echo $this->element('entrar');
}
else {
	echo "Ola " . $var['User']['first_name'];
	echo $this->Html->link(__('Logout'), array('controller'=>'frontend', 'action'=>'logout', 'plugin' => 'usermgmt'));
}
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>
	<ul>
		<?php 
		echo "<li class='".(($actionUrl=='participe') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('participe'), array('controller'=>'frontend', 'action'=>'participe', 'plugin' => 'usermgmt'))."</li>
			  <li class='".(($actionUrl=='regulamento') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('regulamento'), array('controller'=>'frontend', 'action'=>'regulamento', 'plugin' => 'usermgmt'))."</li>
			  <li class='".(($actionUrl=='ranking') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('ranking'), array('controller'=>'frontend', 'action'=>'ranking', 'plugin' => 'usermgmt'))."</li>
			  <li class='".(($actionUrl=='home') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Home'), array('controller'=>'frontend', 'action'=>'index', 'plugin' => 'usermgmt'))."</li>";
		?>
	</ul>