<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
/**
 * News Model
 *
 */
class News extends UserMgmtAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'tittle';

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array();
	function newsValidate() {
		$validate1 = array(
			'title'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the title'),
					'last'=>true)
			),
			'image'=> array(
				'mustValid'=>array(
					'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg', '')),
					'message'=> __('Please supply a valid image'),
					'last'=>true)
			)
		);
		$this->validate=$validate1;
		return $this->validates();
	}
}
