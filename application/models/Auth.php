<?php

class Application_Model_Auth
{


 public function getAuthAdapter(){
    	$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
    	$authAdapter->setTableName('users')->setIdentityColumn('email')->setCredentialColumn('password')->
    	setCredentialTreatment(sprintf("MD5(CONCAT(?,'%s'))", ''));
    	return $authAdapter;
    }

}

