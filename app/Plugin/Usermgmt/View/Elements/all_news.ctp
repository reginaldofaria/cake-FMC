<div id="updateNewsIndex">
	<?php echo $this->Search->searchForm('News', array('legend' => false, 'updateDivId' => 'updateNewsIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateNewsIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('News.tittle', __('News Title')); ?></th>
				<th><?php echo $this->Paginator->sort('News.date_add', __('Created')); ?></th>
				<th><?php echo $this->Paginator->sort('News.active', __('Status')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($news)) {
				$page = $this->request->params['paging']['News']['page'];
				$limit = $this->request->params['paging']['News']['limit'];
				$i=($page-1) * $limit;
				foreach ($news as $row) {
					$i++;
					echo "<tr id='rowId".$row['News']['id']."'>";
					echo "<td>".$i."</td>";
					echo "<td>".h($row['News']['title'])."</td>";
					echo "<td>".date('d/m/Y',strtotime($row['News']['date_add']))."</td>";
					echo "<td id='activeInactive".$row['News']['id']."'>";
					if ($row['News']['active']==1) {
						echo __('Active');
					} else {
						echo __('Inactive');
					}
					echo"</td>";
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
						$inactive = __('Make Active');
						$active = __('Make Inactive');
						if ($row['News']['active']==0) {
							$activeInactive = $inactive;
						} else {
							$activeInactive = $active;
						}
							echo "<li>".$this->Js->link($activeInactive, array('action' => 'makeActiveInactive', $row['News']['id']), array('escape' => false, 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data) { if(data==1) { $('#'+targetId).html('".$active."'); $('#activeInactive".$row['News']['id']."').html('".__('Active')."'); } else { $('#'+targetId).html('".$inactive."'); $('#activeInactive".$row['News']['id']."').html('".__('Inactive')."'); } }"))."</li>";
							echo "<li>".$this->Html->link(__('Edit News'), array('controller'=>'News', 'action'=>'edit', $row['News']['id'], 'page'=>$page), array('escape'=>false))."</li>";
							echo "<li>".$this->Js->link(__('Delete News'), array('action' => 'deleteNews', $row['News']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this news?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['News']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html('Delete News'); }"))."</li>";
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
	<?php if(!empty($news)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of News'))); } ?>
</div>