<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * News Controller
 *
 * @property News $News
 * @property PaginatorComponent $Paginator
 */
class NewsController extends UserMgmtAppController {
	
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
	public $helpers = array('Js', 'Usermgmt.Tinymce', 'Usermgmt.Ckeditor');
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
			'News' => array(
				'News'=> array(
					'type' => 'text',
					'label' => 'Search',
					'tagline' => 'Search by title, content',
					'condition' => 'multiple',
					'searchFields'=>array('News.title', 'News.content'),
					'inputOptions'=>array('style'=>'width:200px;')
				),
				'News.created1'=> array(
					'type' => 'text',
					'condition' => '>=',
					'label' => 'From',
					'inputOptions'=>array('style'=>'width:100px;', 'class'=>'datepicker')
				),
				'News.created2'=> array(
					'type' => 'text',
					'condition' => '<=',
					'label' => 'To',
					'inputOptions'=>array('style'=>'width:100px;', 'class'=>'datepicker')
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
		$this->paginate = array('limit' => 10, 'order'=>'News.id desc');
		$news = $this->paginate('News');
		$this->set('news', $news);
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
			$this->render('/Elements/all_news');
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$this->set('news', $this->News->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	if ($this->request->isPost()) {
			$this->News->set($this->request->data);
			$newsValidate = $this->News->newsValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($newsValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['News']  = $this->News->validationErrors;
					return json_encode($response);
				}
			} else {
				if ($newsValidate) {
					if(is_uploaded_file($this->request->data['News']['image']['tmp_name']) && !empty($this->request->data['News']['image']['tmp_name'])) {
						$path_info = pathinfo($this->request->data['News']['image']['name']);
						chmod ($this->request->data['News']['image']['tmp_name'], 0644);
						$photo=time().mt_rand().".".$path_info['extension'];
						$fullpath= WWW_ROOT."img".DS.IMG_DIR;
						if(!is_dir($fullpath)) {
							mkdir($fullpath, 0777, true);
						}
						move_uploaded_file($this->request->data['News']['image']['tmp_name'],$fullpath.DS.$photo);
						$this->request->data['News']['image']=$photo;
					}
					else {
						$this->request->data['News']['image'] = '';
					}
					$this->request->data['News']['date_add'] = date('Y-m-d');
					$this->News->save($this->request->data,false);
					$this->Session->setFlash(__('The news has been saved'));
					$this->redirect(array('action' => 'index'));					
				}
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
	public function edit($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
			$this->request->data = $this->News->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function deleteNews($newsId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($newsId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res = $this->News->delete($newsId, false);
			if($this->RequestHandler->isAjax()) {
					if($res) {
						echo "1";
					}
				} else {
					if($res) {
						$this->Session->setFlash(__('Selected news is deleted successfully'));
					}
					$this->redirect(array('action'=>'index', 'page'=>$page));
				}
			}
		}
		exit;
	}
}
