<div id="updateGamesIndex">
	<?php echo $this->Search->searchForm('Game', array('legend' => false, 'updateDivId' => 'updateGameIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateGameIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('Game.game', __('Game')); ?></th>
				<th><?php echo $this->Paginator->sort('Game.local', __('Game local')); ?></th>
				<th><?php echo $this->Paginator->sort('Game.date', __('Game date')); ?></th>
				<th><?php echo __('Participant'); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($games)) {
				$page = $this->request->params['paging']['Game']['page'];
				$limit = $this->request->params['paging']['Game']['limit'];
				$i=($page-1) * $limit;
				foreach ($games as $row) {
					$i++;
					echo "<tr id='rowId".$row['Game']['id']."'>";
					echo "<td>".$i."</td>";
					echo "<td>".h($row['Game']['game'])."</td>";
					echo "<td>".h($row['Game']['local'])."</td>";
					echo "<td>".date('d/m/Y',strtotime($row['Game']['date']))."</td>";
					echo "<td>".h($row['User']['name'])."</td>";
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
							echo "<li>".$this->Html->link(__('Edit Game'), array('controller'=>'Games', 'action'=>'edit', $row['Game']['id'], 'page'=>$page), array('escape'=>false))."</li>";
							echo "<li>".$this->Js->link(__('Delete Game'), array('action' => 'deleteGame', $row['Game']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this game?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['Game']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html('Delete Game'); }"))."</li>";
						echo "</ul>";
					echo "</div>";
					echo "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
			} ?>
		</tbody>
	</table>
	<?php if(!empty($news)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Games'))); } ?>
</div>