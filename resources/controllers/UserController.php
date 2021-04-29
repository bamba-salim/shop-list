<?php
  require_once('./resources/controllers/Controllers.php');
  require_once('./resources/models/UserModel.php');
  
  
  class UserController extends Controllers
  {
    
    private static function MODEL()
    {
      return new UserModel();
    }
    
    private static function _results()
    {
      $results = new Results();
      return $results;
    }
    
    public static function add_new_user(CreationUserFormBean $formBean)
    {
      $res = self::_results();
      if (empty($formBean->getUsername()) || empty($formBean->getPassword())) {
        $res->setMessage("veuillez renseignez tous les champs");
        $res->setResponse(self::ERROR);
        return $res;
      } else {
        $user = self::MODEL()->get_user_by_sername($formBean->getUsername());
        if (count($user) === 0) {
          self::MODEL()->create_new_user($formBean);
          $res->setResponse(self::SUCCESS);
          return $res;
        } else {
          $res->setMessage("L'utilisateur existe déjà");
          $res->setData($user);
          return $res;
        }
      }
    }
    
    public static function log_user(CreationUserFormBean $formBean)
    {
      $res = self::_results();
      $res->setResponse(self::ERROR);
  
      if (empty($formBean->getUsername()) || empty($formBean->getPassword())) {
        $res->setMessage("veuillez renseignez tous les champs");
      } else {
        $user = self::MODEL()->get_user_by_sername($formBean->getUsername());
        if (count($user) === 1) {
          var_dump($user[0]->password);
          var_dump($formBean->getPassword());
          $pass = self::MODEL()->pass_verif($formBean->getPassword(), $user[0]->password);
          if ($pass) {
            $res->setData(self::MODEL()->get_user_by_sername($formBean->getUsername())[0]->token);
            var_dump($_SESSION);
            $res->setResponse(self::SUCCESS);
          } else {
            $res->setMessage("Le mot de passe ne correspond pas !");
          }
        } else {
          $res->setResponse("l'utilisateur n'existe pas !");
        }
      }
      return $res;
      
    }
    
    
    public
    static function fetch_all_users()
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_all_users());
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public
    static function fetch_user_by_id(int $id)
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_id($id));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public
    static function fetch_user_by_token(string $token)
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_token($token));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public
    static function fecth_user_by_username(string $username)
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_token($token));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    
  }
