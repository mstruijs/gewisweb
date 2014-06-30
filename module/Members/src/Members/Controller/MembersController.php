<?php

namespace Members\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MembersController extends AbstractActionController {
	
	public function indexAction() {
	
	$vm = new ViewModel();
	return $vm;
	
	}

}
