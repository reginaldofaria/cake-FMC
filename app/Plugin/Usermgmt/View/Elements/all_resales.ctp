<div id="updateResalesIndex">
	<?php echo $this->Search->searchForm('Resale', array('legend' => false, 'updateDivId' => 'updateResaleIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateResaleIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('Resale.name', __('Product name')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($resales)) {
				$page = $this->request->params['paging']['Resale']['page'];
				$limit = $this->request->params['paging']['Resale']['limit'];
				$i=($page-1) * $limit;
				foreach ($resales as $row) {
					$i++;
					echo "<tr id='rowId".$row['Resale']['id']."'>";
					echo "<td>".$i."</td>";
					echo "<td>".h($row['Resale']['name'])."</td>";
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
							echo "<li>".$this->Html->link(__('Edit Resale'), array('controller'=>'Resales', 'action'=>'edit', $row['Resale']['id'], 'page'=>$page), array('escape'=>false))."</li>";
							echo "<li>".$this->Js->link(__('Delete Resale'), array('action' => 'deleteResale', $row['Resale']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this resale?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['Resale']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html('Delete Resale'); }"))."</li>";
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
	<?php if(!empty($news)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Resales'))); } ?>
</div>