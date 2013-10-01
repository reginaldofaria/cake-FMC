<div id="updateProductsIndex">
	<?php echo $this->Search->searchForm('Product', array('legend' => false, 'updateDivId' => 'updateProductIndex')); ?>
	<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateProductIndex')); ?>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><?php echo __('SL');?></th>
				<th><?php echo $this->Paginator->sort('Product.name', __('Product name')); ?></th>
				<th><?php echo __('Action');?></th>
			</tr>
		</thead>
		<tbody>
	<?php   if (!empty($products)) {
				$page = $this->request->params['paging']['Product']['page'];
				$limit = $this->request->params['paging']['Product']['limit'];
				$i=($page-1) * $limit;
				foreach ($products as $row) {
					$i++;
					echo "<tr id='rowId".$row['Product']['id']."'>";
					echo "<td>".$i."</td>";
					echo "<td>".h($row['Product']['name'])."</td>";
					$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
					echo "<td>";
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>Action <span class='caret'></span></button>";
						echo "<ul class='dropdown-menu'>";
							echo "<li>".$this->Html->link(__('Edit Product'), array('controller'=>'Products', 'action'=>'edit', $row['Product']['id'], 'page'=>$page), array('escape'=>false))."</li>";
							echo "<li>".$this->Js->link(__('Delete Product'), array('action' => 'deleteProduct', $row['Product']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this product?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['Product']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html('Delete Product'); }"))."</li>";
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
	<?php if(!empty($news)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Products'))); } ?>
</div>