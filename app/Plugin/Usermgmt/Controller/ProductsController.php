<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * Products Controller
 *
 * @property Products $Products
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends UserMgmtAppController {
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler', 'Usermgmt.Search');
	/**
	 * This controller uses following helpers
	 *
	 * @var array
	 */
	public $helpers = array('Js');
	/**
	 * This controller uses following default pagination values
	 *
	 * @var array
	 */
	public $paginate = array(
			'limit' => 25
	);
	/**
	 * This controller uses search filters in following functions for ex index, online function
	 *
	 * @var array
	 */
	var $searchFields = array
	(
		'index' => array(
			'Product' => array(
				'Product'=> array(
					'type' => 'text',
					'label' => 'Search',
					'tagline' => 'Search by name',
					'searchFields'=>array('Product.name'),
					'inputOptions'=>array('style'=>'width:200px;')
				),
			)
		),
	);
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		if(isset($this->Security) &&  $this->RequestHandler->isAjax()){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = array('limit' => 10, 'order'=>'Product.id desc');
		$products = $this->paginate('Product');
		$this->set('products', $products);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_products');
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->isPost()) {
			$this->Product->set($this->request->data);
			$productsValidate = $this->Product->productsValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($productsValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Product']  = $this->Product->validationErrors;
					return json_encode($response);
				}
			} else {
					$this->Product->save($this->request->data,false);
					$this->Session->setFlash(__('The product has been saved'));
					$this->redirect(array('action' => 'index'));					
			}
		}		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($id)) {
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->Product->set($this->request->data);
				$productsValidate = $this->Product->productsValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($productsValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Products']  = $this->Product->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($productsValidate){
						$this->Product->save($this->request->data,false);
						$this->Session->setFlash(__('The product has been saved'));
						$this->redirect(array('action'=>'edit', $id, 'page'=>$page));
					}
				}
			}  else {
				$this->request->data = $this->Product->read(null, $id);
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deleteProduct($productId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($productId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res = $this->Product->delete($productId, false);
			if($this->RequestHandler->isAjax()) {
					if($res) {
						echo "1";
					}
				} else {
					if($res) {
						$this->Session->setFlash(__('Selected product is deleted successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
}
