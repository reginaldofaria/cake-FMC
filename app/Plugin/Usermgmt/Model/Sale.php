<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
/**
 * Sale Model
 *
 * @property User $User
 * @property Product $Product
 */
class Sale extends UserMgmtAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'user_id';

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array();
	function saleValidate() {
		$validate = array(
			'user_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message'=> __('Please enter the participant'),
					'last'=>true)
			),
			'product_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message'=> __('Please enter the product'),
					'last'=>true)
			),
			'litros_hectares'=> array(
				'mustNotEmpty'=>array(
				'rule' => 'notEmpty',
				'message'=> __('Please enter the litros/hectares'),
				'last'=>true)
			),
		);
		$this->validate=$validate;
		return $this->validates();
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/*public $belongsTo = array(
		'Usermgmt.User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usermgmt.Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
	public $hasOne = array('Usermgmt.User', 'Usermgmt.Product');
	
}
