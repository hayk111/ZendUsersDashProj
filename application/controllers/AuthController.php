<?php
class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = 'Login';


    }

   	public function loginAction(){
    /*  $obj = new Auth();
$authAdapter = $obj->getAuthAdapter();*/
   		
   			
   		
$request = $this->getRequest();

   		$authAdapter = $this->getAuthAdapter();
   			$email = $request->getPost('email');
   			$pass = $request->getPost('password');
   			$authAdapter->setIdentity($email)->setCredential($pass);
   			$auth = Zend_Auth::getInstance();
   			$result = $auth->authenticate($authAdapter);
   			if($result->isValid()){
   				$identity = json_encode($authAdapter->getResultRowObject());
   					//var_dump(json_decode(json_encode($identity), true)); die;
   				
					 

   				$this->view->users = json_decode($identity, true);
   				//echo $identity[0]['user_id']; die;

   			}  else {
   				echo "invalid";
   			}
    	}

    public function logoutAction(){

    }
    private function getAuthAdapter(){
    	$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
    	$authAdapter->setTableName('users')->setIdentityColumn('email')->setCredentialColumn('password')->
    	setCredentialTreatment(sprintf("MD5(CONCAT(?,'%s'))", ''));
    	return $authAdapter;
    }

}

