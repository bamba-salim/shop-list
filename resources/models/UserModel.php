<?php
  require_once('./resources/models/Model.php');
  require_once('./resources/dao/UserDAO.php');
  
  
  class UserModel extends Model
  {
    
    private function DAO()
    {
      return new UserDAO();
    }
    
    // get users list
    public function get_all_users()
    {
      return self::DAO()->find_all();
    }
    
    
    // get single user
    
    public function get_user_by_username(string $user)
    {
      return self::DAO()->find_by_username($user);
    }
    
    public function get_user_by_id($id)
    {
      return self::DAO()->find_by_id($id);
    }
    
    public function get_user_by_token(string $token)
    {
      return self::DAO()->find_by_token($token);
    }
    
    // create user
    
    public function create_new_user(CreationUserFormBean $formbean)
    {
      $formbean->setToken($this->generate_user_token());
      $formbean->setPassword($this->pass_crypt($formbean->getPassword()));
      $formbean->setCreatedAt($this->_date());
      self::DAO()->create_new_user($formbean);
    }
    
    public function switch_actived(int $idUser)
    {
      $user = $this->get_user_by_id($idUser);
      $active = $user[0]->active === '1' ? false : true;
      self::DAO()->switch_actived($idUser, $active);
    }
    
    ########## GETTERS & SETTERS ##########
    
  }
