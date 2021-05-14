<?php
  require_once('./resources/config.php');
  require_once('./resources/controllers/UserController.php');
  require_once('./resources/bean/CreationUserFormBean.php');
  
  header("Content-type: application/json; charset=utf-8");
  
  if (isset($_GET['add'])) {
    switch ($_GET['add']) {
      case 'user':
        $data = json_decode(file_get_contents("php://input"));
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($data->user->newPassword);
        $formBean->setUsername($data->user->newUsername);
        $results = UserController::add_new_user($formBean);
        echo json_encode($results);
        break;
      case 'list':
        var_dump('list');
        break;
      case 'item':
        var_dump('item');
        break;
      default:
        echo json_encode('echec');
    }
    
  }
  
  if (isset($_GET['log'])) {
    switch ($_GET['log']) {
      case 'user':
        $data = json_decode(file_get_contents("php://input"));
        $formBean = new CreationUserFormBean();
        $formBean->setPassword($data->user->password);
        $formBean->setUsername($data->user->username);
        $results = UserController::log_user($formBean);
        echo json_encode($results);
        break;
      default:
        echo json_encode('echec');
  
    }
  }
  
  if (isset($_GET['fetch'])) {
    switch ($_GET['fetch']) {
      case 'user':
        if (!isset($_GET['token'])) header('location: ./');
        $results = UserController::fetch_user_by_token($_GET['token']);
        echo json_encode($results);
        break;
      case 'users':
        $results = UserController::fetch_all_users();
        echo json_encode($results);
        break;
      default:
        echo json_encode('echec');
    }
  }
  
  if (isset($_GET['set'])) {
    switch ($_GET['set']) {
      case 'user-active':
        $data = json_decode(file_get_contents("php://input"));
        $results = UserController::switch_actived($data->id);
        echo json_encode($results);
        break;
      default:
        echo json_encode('echec');
    }
  }
  
  if (isset($_GET['del'])) {
    
    switch ($_GET['del']) {
      case 'user-id':
        $data = json_decode(file_get_contents("php://input"));
        $results = UserController::delete_user($data->id);
        echo json_encode($results);
        break;
      default:
        echo json_encode('echec');
    }
  }
