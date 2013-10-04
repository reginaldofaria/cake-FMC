<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * Games Controller
 *
 * @property Games $Games
 * @property PaginatorComponent $Paginator
 */
class GamesController extends UserMgmtAppController {
	
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
			'Game' => array(
				'Game'=> array(
					'type' => 'text',
					'label' => 'Search',
					'tagline' => 'Search by game and local',
					'condition' => 'multiple',
					'searchFields'=>array('Game.game', 'Game.local'),
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
		$this->paginate = array('limit' => 10, 'order'=>'Game.id desc');
		$games = $this->paginate('Game');
		$i=0;
		foreach($games as $game) {
			$this->Game->User->getUserNameById($game['Game']['user_id']);
			$games[$i]['User']['name'] = $this->Game->User->getUserNameById($game['Game']['user_id']);
			$i++;
		}
		$this->set('games', $games);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_games');
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$users = $this->Game->User->getAllUsersWithUserIds('', array('User.user_group_id' => GUEST_GROUP_ID));
		$this->set(compact('users', $users));
		if ($this->request->isPost()) {
			$this->Game->set($this->request->data);
			$gameValidate = $this->Game->gameValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($gameValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Game']  = $this->Game->validationErrors;
					return json_encode($response);
				}
			} else {
					$this->Game->save($this->request->data,false);
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
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($id)) {
			$users = $this->Game->User->getAllUsersWithUserIds('', array('User.user_group_id' => GUEST_GROUP_ID));
			$this->set(compact('users', $users));
			if ($this->request->isPut() || $this->request->isPost()) {
				$this->Game->set($this->request->data);
				$gameValidate = $this->Game->gameValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($gameValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Game']  = $this->Game->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($gameValidate){
						$this->Game->save($this->request->data,false);
						$this->Session->setFlash(__('The game has been saved'));
						$this->redirect(array('action'=>'edit', $id, 'page'=>$page));
					}
				}
			}  else {
				$this->request->data = $this->Game->read(null, $id);
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
	public function deleteGame($gameId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($gameId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res = $this->Game->delete($gameId, false);
			if($this->RequestHandler->isAjax()) {
					if($res) {
						echo "1";
					}
				} else {
					if($res) {
						$this->Session->setFlash(__('Selected game is deleted successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
}
