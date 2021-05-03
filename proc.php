<?php
  require_once('./resources/config.php');
  require_once('./resources/controllers/UserController.php');
  require_once('./resources/bean/CreationUserFormBean.php');

//  header('Content-Type: application/json');
  header("Content-type: application/json; charset=utf-8");
  
  if (isset($_GET['add'])) {
    switch ($_GET['add']) {
      case 'user':
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($password);
        $formBean->setUsername($username);
        $results = UserController::add_new_user($formBean);
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
        $data = json_decode(file_get_contents("php://input"));
//        var_dump($data);

//
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($data->user->password);
        $formBean->setUsername($data->user->username);
        $results = UserController::log_user($formBean);
        if ($results->getResponse() === 'success') {
          echo json_encode($results);
        } else {
          echo json_encode($results);
        }
        break;
      default:
        var_dump('redirect');
      
    }
    
  }
  
