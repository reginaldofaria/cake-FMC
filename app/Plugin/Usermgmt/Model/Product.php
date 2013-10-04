<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
/**
 * Product Model
 *
 */
class Product extends UserMgmtAppModel {

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
	function productsValidate() {
		$validate1 = array(
			'name'=> array(
				'mustNotEmpty'=>array(
					'rule' => 'notEmpty',
					'message'=> __('Please enter the name'),
					'last'=>true)
			)
		);
		$this->validate=$validate1;
		return $this->validates();
	}
	/**
	 * Used to get all products
	 *
	 * @access public
	 * @return boolean
	 */
	function getAllProducts() {
		$products=array();
		$res = $this->find('all', array('fields'=>array('Product.id', 'Product.name')));
		foreach($res as $row) {
			$products[$row['Product']['id']]=$row['Product']['name'];
		}
		return $products;
	}
	/**
	 * Used to get product by product id
	 *
	 * @access public
	 * @param integer $productId user id
	 * @return string
	 */
	public function getProductById($productId) {
		$res=$this->find('first', array('conditions'=>array('Product.id'=>$productId), 'fields'=>array('Product.name')));
		$name=(!empty($res)) ? ($res['Product']['name']) : '';
		return $name;
	}
}
