<div id="updateNewsIndex">
<?php 
	echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateNewsIndex')); 
	if($news){
		foreach ($news as $row){
			if(!empty($row['News']['image'])){
				echo $this->Html->link(
						$this->Html->image($this->Image->resize('img/'.IMG_DIR, $row['News']['image'], 250, null, true), array("alt" => $row['News']['title'])),
						array('action' => 'noticias', $row['News']['id']),
						array('escape' => false)
				);
			}
			if($row['News']['rss']){
				echo $this->Html->link($row['News']['title'], $row['News']['link'], array('target' => '_blank'));
			}		
			else {
				echo $this->Html->link($row['News']['title'], array('action' => 'noticias', $row['News']['id']), array('target' => '_self'));
			}
			echo 'Conteúdo:'. $row['News']['content'] . '</br>';
			echo '--------------------<br />';
		}
		if(!empty($news)) {
			echo $this->element('pagination_frontend');
		}
	}
?>
</div>