<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * Sales Controller
 *
 * @property Sales $Sales
 * @property PaginatorComponent $Paginator
 */
class SalesController extends UserMgmtAppController {
	
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
			'Sale' => array(
				'Sale'=> array(
					'type' => 'text',
					'label' => 'Search',
					'tagline' => 'Search by participant and product',
					'condition' => 'multiple',
					'searchFields'=>array('Sale.user_id', 'Sale.product_id'),
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
		$this->paginate = array('limit' => 10, 'order'=>'Sale.id desc');
		$sales = $this->paginate('Sale');
		$i=0;
		foreach($sales as $sale) {
			$this->Sale->User->getUserNameById($sale['Sale']['user_id']);
			$sales[$i]['User']['name'] = $this->Sale->User->getUserNameById($sale['Sale']['user_id']);
			$sales[$i]['Product']['name'] = $this->Sale->Product->getProductById($sale['Sale']['product_id']);
			$i++;
		}
		$this->set('sales', $sales);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_sales');
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$users = $this->Sale->User->getAllUsersWithUserIds('', array('User.user_group_id' => GUEST_GROUP_ID));
		$products = $this->Sale->Product->getAllProducts();
		$this->set(compact('users', $users));
		$this->set(compact('products', $products));
		if ($this->request->isPost()) {
			$this->Sale->set($this->request->data);
			$saleValidate = $this->Sale->saleValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($saleValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Sale']  = $this->Sale->validationErrors;
					return json_encode($response);
				}
			} else {
					$this->Sale->save($this->request->data,false);
					$this->Session->setFlash(__('The game has been saved'));
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
		$page = (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($id)) {
			$users = $this->Sale->User->getAllUsersWithUserIds('', array('User.user_group_id' => GUEST_GROUP_ID));
			$products = $this->Sale->Product->getAllProducts();
			$this->set(compact('users', $users));
			$this->set(compact('products', $products));
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->Sale->set($this->request->data);
				$saleValidate = $this->Sale->saleValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($saleValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Sale']  = $this->Sale->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($saleValidate){
						$this->Sale->save($this->request->data,false);
						$this->Session->setFlash(__('The game has been saved'));
						$this->redirect(array('action'=>'edit', $id, 'page'=>$page));
					}
				}
			}  else {
				$this->request->data = $this->Sale->read(null, $id);
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
	public function deleteSale($saleId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($saleId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res = $this->Sale->delete($saleId, false);
			if($this->RequestHandler->isAjax()) {
					if($res) {
						echo "1";
					}
				} else {
					if($res) {
						$this->Session->setFlash(__('Selected sale is deleted successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
}
