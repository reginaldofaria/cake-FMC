<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
/**
 * Game Model
 *
 */
class Game extends UserMgmtAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'game';

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array();
	function gameValidate() {
		$validate = array(
			'game'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the game'),
					'last'=>true)
			),
			'user_id'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the participant'),
					'last'=>true)
			)
				
		);
		$this->validate=$validate;
		return $this->validates();
	}
	
	var $hasOne = array('Usermgmt.User');
	
	
}
