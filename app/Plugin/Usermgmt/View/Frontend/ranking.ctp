<?php 
if(!$this->UserAuth->isLogged()) {
	echo 'Você precisa estar logado!';
}
else { ?>
<table>
	<thead>
		<th></th>
		<th>Nome</th>
		<th>Produto</th>
		<th>L/Hectares</th>
		<th>Produto</th>
		<th>L/Hectares</th>
		<th>Total</th>
	</thead>
	<?php for($i=0; $i<count($users); $i++){ ?>
		<tr>
			<td><?php echo $i+1 . $this->Html->image($this->Image->resize('img/'.IMG_DIR, $users[$i]['foto'], 250, null, true), array("alt" => $users[$i]['foto']));?>
			<td><?php echo $users[$i]['nome'];?></td>
			<?php for($j=0; $j<count($users[$i]['produto']); $j++){?>
			<td><?php echo $users[$i]['produto'][$j];?></td>
			<td><?php echo $users[$i]['litros_hectares'][$j];?></td>
			<?php }?>
			<td><?php echo $users[$i]['total'];?></td>
		</tr>
	<?php } ?>
</table>
	
	
	
<?php }?>