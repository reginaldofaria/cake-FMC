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
				'News.active' => array(
					'type' => 'select',
					'label' => 'Status',
					'options' => array(''=>'Select', '1'=>'Active', '0'=>'Inactive')
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
 * 
 *
 * @throws 
 * @param 
 * @return 
 */
	public function loadFeed($rss = null) {
		App::import('Utility', 'Xml');
		$rss = 'http://br.esporteinterativo.yahoo.com/futebol/copa-mundo/?format=rss';
		try {
			$feed = Xml::build($rss, array('return' => 'simplexml'));
		} catch (XmlException $e) {
			//throw new InternalErrorException();
			$this->Session->setFlash(__('Sorry the feed cannot be loaded'), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		foreach ($feed->channel->item as $item){
			$news_sinc = $this->News->find('all', array(
					'conditions' => array('News.pubDate' => $item->pubDate, 'News.rss' => true)
			));
			if(empty($news_sinc)){
				$news_rss['title'] = $item->title;
				$news_rss['content'] = $item->description . "<br /><a href='$item->link' title='$item->title' target='new'>$item->link</a>";
				$news_rss['pubDate'] = $item->pubDate;
				$news_rss['link'] = $item->link;
				$news_rss['date_add'] = date('Y/m/d');
				$news_rss['active'] = false;
				$news_rss['rss'] = true;
				$this->News->set($news_rss);
				$validate = $this->News->newsValidate();
				if($validate){
					$this->News->create();
					$this->News->save($news_rss, false);
				}	
				else {
					$this->Session->setFlash(__('Sorry the feed cannot be loaded'), 'default', array('class' => 'error'));
					$this->redirect(array('action'=>'index'));
				}	
			}
			else {
				//atualiza
			}
		}
		$this->Session->setFlash(__('The feed has been loaded'));
		$this->redirect(array('action'=>'index'));
		exit;
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
	public function edit($id=null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		if (!empty($id)) {
			if ($this->request->isPut() || $this->request->isPost()) {
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
							if(!empty($this->request->data['News']['image_registered']) && file_exists($fullpath.DS.$this->request->data['News']['image_registered'])) {
								unlink($fullpath.DS.$this->request->data['News']['image_registered']);
							}							
						} else {
							if(isset($this->request->data['News']['remove_image']) && $this->request->data['News']['remove_image']){
								$fullpath= WWW_ROOT."img".DS.IMG_DIR;
								if(!empty($this->request->data['News']['image_registered']) && file_exists($fullpath.DS.$this->request->data['News']['image_registered'])) {
									unlink($fullpath.DS.$this->request->data['News']['image_registered']);
									unset($this->request->data['News']['image_registered']);
								}
								$this->request->data['News']['image'] = '';
								unset($this->request->data['News']['remove_image']);
							}
							if(!empty($this->request->data['News']['image_registered'])){
								$this->request->data['News']['image'] = $this->request->data['News']['image_registered'];
								unset($this->request->data['News']['image_registered']);
								
							} 
							else {		
								$this->request->data['News']['image'] = '';
							}
						}
						$this->News->save($this->request->data,false);
						$this->Session->setFlash(__('The news has been saved'));
						$this->redirect(array('action'=>'edit', $id, 'page'=>$page));
					}
				}
			}  else {
				$this->request->data = $this->News->read(null, $id);
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}
	
	/**
	 * It is used to activate or deactivate from all news
	 *
	 * @access public
	 * @param integer $newsId user id of news
	 * @return string
	 */
	public function makeActiveInactive($newsId = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		$msg=__('Sorry there was a problem, please try again');
		if (!empty($newsId)) {
			if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
				$res=$this->News->find('first', array('conditions' => array('News.id'=>$newsId), 'fields' => array('News.active')));
				if(!empty($res)) {
					if($res['News']['active']) {
						$this->News->id = $newsId;
						$this->News->saveField('active', 0, false);
					} else {
						$this->News->id = $newsId;
						$this->News->saveField('active', 1, false);
					}
					if($this->RequestHandler->isAjax()) {
						if($res['News']['active']) {
							echo '0';
						} else {
							echo '1';
						}
					} else {
						if($res['News']['active']) {
							$this->Session->setFlash(__('Selected news is de-activated successfully'));
						} else {
							$this->Session->setFlash(__('Selected news is activated successfully'));
						}
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			}
		}
		exit;
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
