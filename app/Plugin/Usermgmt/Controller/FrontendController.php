<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
class FrontendController extends UserMgmtAppController {
	
	public $layout = 'frontend';
	public $uses = array('Usermgmt.News', 
						 'Usermgmt.User',
						 'Usermgmt.UserGroup',
						 'Usermgmt.UserSetting',
						 'Usermgmt.UserDetail',
						 'Usermgmt.UserActivity',
						 'Usermgmt.LoginToken',
						 'Usermgmt.UserGroupPermission',
						 'Usermgmt.Resale',
						 'Usermgmt.Sale',
						 'Usermgmt.Product');
	public $components = array('RequestHandler', 'Usermgmt.UserConnect', 'Cookie', 'Usermgmt.ControllerList');
	public $helpers = array('Js');
	public $paginate = array('limit' => 25);
	
	/**
	 * Called before the controller action.  You can use this method to configure and customize components
	 * or perform logic that needs to happen before each controller action.
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->User->userAuth=$this->UserAuth;
		if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->action=='login' || $this->action=='addMultipleUsers')){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}
	
	function index() {
		$this->paginate = array('limit' => 4, 'order'=>'News.date_add desc', 'conditions' => array('News.active' => true));
		$news = $this->paginate('News');
		$this->set('news', $news);
	}
	
	function regulamento() {
			
	}
	
	function ranking() {
		/*$users = $this->User->find('all', 
					array('conditions' => array('User.resale_id !=' => '', 'User.active' => true), 
					'fields' => array('User.id', 'User.first_name'),
					'limit' => 5)
				);*/
		$users = $this->User->query('select u.id, u.first_name as nome, d.photo as foto, sum(s.litros_hectares) as total 
									from users as u, sales as s, user_details as d
									where s.user_id = u.id
									and u.id = d.user_id
									group by nome, u.id, d.photo
									order by total desc
									limit 5;');
		$i=0;
		foreach ($users as $user){
			$nusers[$i] = array_shift($user);
			$i++;
		}
		
		for($i=0; $i<count($nusers); $i++){
			$sales = $this->Sale->find('all', array('conditions' => array('user_id' => $nusers[$i]['id'])));
			foreach ($sales as $sale){
				$nusers[$i]['produto'][] = $this->Product->getProductById($sale['Sale']['product_id']);
				$nusers[$i]['litros_hectares'][] = $sale['Sale']['litros_hectares'];
			}
		}
		$this->set('users', $nusers);
		
	}
	
	function campeao() {
			
	}
	
	function participe() {
		if ($this->request->isPost()) {
			$this->User->set($this->request->data);
			$this->UserDetail->set($this->request->data);
			$this->Resale->set($this->request->data);
			$this->request->data['User']['username'] = $this->request->data['User']['email'];
			$this->request->data['User']['user_group_id'] = DEFAULT_GROUP_ID;
			$UserRegisterValidate = $this->User->ParticipeValidate();
			//$userPhotoValidate = $this->UserDetail->ParticipePhotoValidate();
			$codigoRevendaValidate = $this->Resale->codigoValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($UserRegisterValidate && $codigoRevendaValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['User']   = $this->User->validationErrors;
					$response['data']['Resale']   = $this->Resale->validationErrors;
					return json_encode($response);
				}
				//VALIDANDO EXTENSÃO DA FOTO
				/*if ($userPhotoValidate) {
					$response = array('error' => 0, 'message' => 'success');
					//return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['User']   = $this->UserDetail->validationErrors;
					//return json_encode($response);
				}*/
				//VALIDANDO CÓDIGO DA REVENDA
			} else {
				if ($UserRegisterValidate && $codigoRevendaValidate) {
					if(is_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name']) && !empty($this->request->data['UserDetail']['photo']['tmp_name'])){
						$path_info = pathinfo($this->request->data['UserDetail']['photo']['name']);
						chmod ($this->request->data['UserDetail']['photo']['tmp_name'], 0644);
						$photo=time().mt_rand().".".$path_info['extension'];
						$fullpath= WWW_ROOT."img".DS.IMG_DIR;
						if(!is_dir($fullpath)) {
							mkdir($fullpath, 0777, true);
						}
						move_uploaded_file($this->request->data['UserDetail']['photo']['tmp_name'],$fullpath.DS.$photo);
						$this->request->data['UserDetail']['photo']=$photo;
						if(!empty($user['UserDetail']['photo']) && file_exists($fullpath.DS.$user['UserDetail']['photo'])) {
							unlink($fullpath.DS.$user['UserDetail']['photo']);
						}
					}
					else {
						$this->request->data['UserDetail']['photo'] = '';
					}
					$this->request->data['User']['email_verified']=1;
					$this->request->data['User']['active']=1;
					if(isset($_SERVER['REMOTE_ADDR'])) {
						$this->request->data['User']['ip_address']=$_SERVER['REMOTE_ADDR'];
					}
					$salt = $this->UserAuth->makeSalt();
					$this->request->data['User']['salt']=$salt;
					$this->request->data['User']['password'] = $this->UserAuth->makePassword($this->request->data['User']['password'], $salt);
					$this->User->save($this->request->data,false);
					$userId=$this->User->getLastInsertID();
					$this->request->data['UserDetail']['user_id']=$userId;
					$this->UserDetail->save($this->request->data,false);
					$this->User->contain('UserDetail');
					$user = $this->User->getUserById($userId);
					/*if (SEND_REGISTRATION_MAIL && !EMAIL_VERIFICATION) {
						$this->User->sendRegistrationMail($user);
					}*/
					$this->UserAuth->login($user);
					$this->Session->setFlash(__('registrado'));
					$this->redirect(array('action' => 'index'));
				
				}
			}
		} else {
			$this->set('resales', $this->Resale->getAllResales());
		}	
	}
	
	function noticias($id=null) {
		if (!empty($id)) {
			$set_news = $this->News->findById($id);
		}
		else {
			$set_news = $this->News->find('first', array('conditions' => array('News.active' => true), 'orderby' => 'News.date_add asc'));
		}
		$this->set(compact('set_news', $set_news));
			
	}
	
	public function entrar($connect=null) {
		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			if($connect) {
				$this->render('popup');
			} else {
				$this->redirect(array('controller' => 'frontend', 'action' => 'index'));
			}
		}
	
		if ($this->request->isPost()) {
			$errorMsg="";
			$this->User->set($this->request->data);
			$UserLoginValidate = $this->User->LoginValidate();
			if($UserLoginValidate) {
				$email  = $this->request->data['User']['email'];
				$password = $this->request->data['User']['password'];
				$this->User->contain('UserDetail');
				$user = $this->User->findByUsername($email);
				if(empty($user)) {
					$user = $this->User->findByEmail($email);
					if (empty($user)) {
						$this->UserAuth->setBadLoginCount();
						$errorMsg = __('Incorrect Email/Username or Password', true);
					}
				}
				if($user) {
					$hashed = $this->UserAuth->makePassword($password, $user['User']['salt']);
					if (!$user['User']['password'] === $hashed) {
						$this->UserAuth->setBadLoginCount();
						$errorMsg = __('Incorrect Email/Username or Password', true);
					} 
				}
			}
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($UserLoginValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					if(empty($errorMsg)) {
						$response['data']['User'] = $this->User->validationErrors;
					} else {
						if($this->UserAuth->captchaOnBadLogin()) {
							// need to submit login for captcha validation
							$response = array('error' => 0, 'message' => 'success');
						} else {
							$response['data']['User'] = array('email'=>array($errorMsg));
						}
					}
					return json_encode($response);
				}
			} else {
				if ($UserLoginValidate) {
					$this->UserAuth->login($user);
					$remember = (!empty($this->request->data['User']['remember']));
					if ($remember) {
						$this->UserAuth->persist('2 weeks');
					}
					$OriginAfterLogin=$this->Session->read('Usermgmt.OriginAfterLogin');
					$this->Session->delete('Usermgmt.OriginAfterLogin');
					$redirect = (!empty($OriginAfterLogin)) ? $OriginAfterLogin : LOGIN_FRONTEND_REDIRECT_URL;
					$this->redirect($redirect);
				} else {
					if(empty($errorMsg)) {
						$errorMsg = __('Please fill recaptcha code', true);
					}
					$this->Session->setFlash($errorMsg, 'default', array('class' => 'warning'));
				}
			}
		}		
	}
	
	public function logout($msg=true) {
		$this->UserAuth->logout();
		if($msg) {
			$this->Session->setFlash(__('You are successfully signed out'));
		}
		$this->redirect(LOGOUT_FRONTEND_REDIRECT_URL);
	}
	
	public function sortArray( $data, $field ) {
	    $field = (array) $field;
	    uasort( $data, function($a, $b) use($field) {
	        $retval = 0;
	        foreach( $field as $fieldname ) {
	            if( $retval == 0 ) $retval = strnatcmp( $a[$fieldname], $b[$fieldname] );
	        }
	        return $retval;
	    } );
	    return $data;
	}
	
	
}