<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        $this->db = Zend_Db_Table::getDefaultAdapter();
    }

    public function indexAction()
    {
        $users = $this->db->query('SELECT * FROM users')->fetchAll();

        $this->view->users = $users;
        //print_r($users);
    }

    public function editAction() {
    	$this->_helper->viewRenderer->setNoRender();

    	$data = json_decode($this->_getParam('data'));
		
		$userId = intval(substr($data[0]->userId, 5));
		
		$name = $data[1]->value;
		$lastname = $data[2]->value;
		$email = $data[3]->value;
		$phone = $data[4]->value;
		$password = md5($data[5]->value);

		if (strpos($phone, '+') == false) {
		    $phone = '+' . $phone;
		}

    	$data = array(
		    'firstname' => $name,
		    'lastname'	=> $lastname,
		    'email'	    => $email,
		    'mobile'	=> $phone,
		    'password'	=> $password
		);
		 
		$update = $this->db->update('users', $data, 'user_id = ' . $userId);

    	//$this->_helper->json($userId);
    }

    public function addAction() {
    	$form = new Application_Form_Adduser();
    	$this->view->form = $form;
    }

    public function saveAction() {
    	//$this->_helper->viewRenderer->setNoRender();

    	$name = $this->getRequest()->getPost('firstname', null);
    	$lname = $this->getRequest()->getPost('lastname', null);
    	$email = $this->getRequest()->getPost('email', null);
    	$mobile = $this->getRequest()->getPost('mobile', null);
		$password = $this->getRequest()->getPost('password', null);

		$data = array(
		    'firstname' => $name,
		    'lastname'	=> $lname,
		    'email'	    => $email,
		    'mobile'	=> $mobile,
		    'password'	=> $password
		);

		$this->view->name = $lname;

		if(($name == '') || ($lname == '') || ($email == '') || ($password == '')) 
			$this->redirect('/users/add');
		else {
			$insert = $this->db->insert('users', $data);
			$this->redirect('/users/');
		}

		
    }
}

