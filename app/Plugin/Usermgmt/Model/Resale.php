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
	
	function codigoValidate(){
		$validate2 = array(
			'code'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Por favor digite seu código'),
					'last'=>true),
				'mustExists'=>array(
					'rule' =>'codeExists',
					'message' =>'Código inexistente',
					'last'=>true),
				'mustCodeResale'=>array(
					'rule' =>'codeResale',
					'message' =>'Este código não faz relação a essa revenda',
					'last'=>true)
			)
		);
		$this->validate=$validate2;
		return $this->validates();
	}
	
	function codeExists($code){
		if($this->findByCode($code['code'])){
			return true;
		} else {
			return false;
		}
	}
	
	function codeResale($code){
		if($this->find('all', array('conditions' => array('Resale.code' => $code['code'], 'Resale.id' => $this->data['User']['resale_id'])))){
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Used to get all resales
	 *
	 * @access public
	 * @return boolean
	 */
	function getAllResales() {
		$resales=array();
		$res = $this->find('all', array('fields'=>array('Resale.id', 'Resale.name')));
		foreach($res as $row) {
			$resales[$row['Resale']['id']]=$row['Resale']['name'];
		}
		return $resales;
	}
}
