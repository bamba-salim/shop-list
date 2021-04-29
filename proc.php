<?php
  require_once('./resources/config.php');
  require_once('./resources/controllers/UserController.php');
  require_once('./resources/bean/CreationUserFormBean.php');
  
  var_dump("get:");
  var_dump( $_GET);
  
  var_dump("post:");
  var_dump($_POST);
  
  var_dump("session:");
  var_dump($_SESSION);
  
  extract($_POST);
  
  if (isset($_GET['add'])) {
    switch ($_GET['add']) {
      case 'user':
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($password);
        $formBean->setUsername($username);
        $result = UserController::add_new_user($formBean);
        var_dump($result);
        break;
      case 'list':
        var_dump('list');
        break;
      case 'item':
        var_dump('item');
        break;
      default:
        var_dump('redirect');
      
    }
    
  }
  
  if (isset($_GET['log'])) {
    switch ($_GET['log']) {
      case 'user':
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($password);
        $formBean->setUsername($username);
        $result = UserController::log_user($formBean);
        var_dump($result);
        break;
      default:
        var_dump('redirect');
      
    }
    
  }
