<div id="updateSalesIndex">
	<?php echo $this->Search->searchForm('Sale', array('legend' => false, 'updateDivId' => 'updateSaleIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateSaleIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('User.name.', __('Participant')); ?></th>
				<th><?php echo $this->Paginator->sort('Product.name.', __('Product')); ?></th>
				<th><?php echo $this->Paginator->sort('Sale.litros_hectares', __('litros/hectares')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($sales)) {
				$page = $this->request->params['paging']['Sale']['page'];
				$limit = $this->request->params['paging']['Sale']['limit'];
				$i=($page-1) * $limit;
				foreach ($sales as $row) {
					$i++;
					echo "<tr id='rowId".$row['Sale']['id']."'>";
					echo "<td>".$i."</td>";
					echo "<td>".h($row['User']['name'])."</td>";
					echo "<td>".h($row['Product']['name'])."</td>";
					echo "<td>".h($row['Sale']['litros_hectares'])."</td>";
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
							echo "<li>".$this->Html->link(__('Edit Sale'), array('controller'=>'Sales', 'action'=>'edit', $row['Sale']['id'], 'page'=>$page), array('escape'=>false))."</li>";
							echo "<li>".$this->Js->link(__('Delete Sale'), array('action' => 'deleteSale', $row['Sale']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this game?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['Sale']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html('Delete Sale'); }"))."</li>";
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
	<?php if(!empty($news)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Sales'))); } ?>
</div>