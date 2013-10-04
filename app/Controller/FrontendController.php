<?php
class FrontendController extends AppController {
	
	public $layout = 'frontend';
	public $uses = array('Usermgmt.News', 
						'Usermgmt.User',
						 'Usermgmt.UserGroup',
						 'Usermgmt.UserSetting',
						 'Usermgmt.TmpEmail',
						 'Usermgmt.UserDetail',
						 'Usermgmt.UserActivity',
						 'Usermgmt.LoginToken',
						 'Usermgmt.UserGroupPermission');
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
		 $news = $this->News->find('all');
		 $this->set('news', $news);
	}
	
	function regulamento() {
			
	}
	
	function ranking() {
			
	}
	
	function campeao() {
			
	}
	
	function participe() {
			
	}
	
	function tabela() {
			
	}
	
	
	
public function login($connect=null) {
		$userId = $this->UserAuth->getUserId();
		if ($userId) {
			if($connect) {
				$this->render('popup');
			} else {
				$this->redirect(array('action' => 'index'));
			}
		}
	
		if ($this->request->isPost()) {
			$errorMsg="";
			$loginValid=false;
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
				if ($UserLoginValidate && $loginValid) {
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
				if ($UserLoginValidate && $loginValid) {
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
}