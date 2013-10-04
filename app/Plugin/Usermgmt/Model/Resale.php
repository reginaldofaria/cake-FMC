<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
/**
 * Resale Model
 *
 */
class Resale extends UserMgmtAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array();
	function resaleValidate() {
		$validate1 = array(
			'name'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the name'),
					'last'=>true)
			),
			'code'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the code'),
					'last'=>true)
			)
		);
		$this->validate=$validate1;
		return $this->validates();
	}
}
