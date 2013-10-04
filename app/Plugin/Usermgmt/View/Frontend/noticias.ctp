<?php 
	if(!empty($set_news)){
		if(!empty($set_news['News']['image'])){
				echo $this->Html->image($this->Image->resize('img/'.IMG_DIR, $set_news['News']['image'], 250, null, true), array("alt" => $set_news['News']['title'], 'title' => $set_news['News']['title']));
		}
		echo $set_news['News']['title'];
		echo $set_news['News']['content'];
	}
?>