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
      return new Results();
    }
    
    public static function add_new_user(CreationUserFormBean $formBean): Results
    {
      $res = self::_results();
      $res->setResponse(self::ERROR);
      if (empty($formBean->getUsername()) || empty($formBean->getPassword())) {
        $res->setMessage("veuillez renseignez tous les champs");
      } else {
        $user = self::MODEL()->get_user_by_username($formBean->getUsername());
        if (count($user) === 0) {
          self::MODEL()->create_new_user($formBean);
          $newUser = self::MODEL()->get_user_by_username($formBean->getUsername());
          $res->setData($newUser[0]->token);
          $res->setResponse(self::SUCCESS);
        } else {
          $res->setMessage("Nom d'utilisateur indisponible ou connectez vous !");
        }
      }
      return $res;
      
    }
    
    public static function log_user(CreationUserFormBean $formBean): Results
    {
      $res = self::_results();
      $res->setResponse(self::ERROR);
      if (empty($formBean->getUsername()) || empty($formBean->getPassword())) {
        $res->setMessage("Veuillez renseignez tous les champs");
      } else {
        $user = self::MODEL()->get_user_by_username($formBean->getUsername());
        if (count($user) === 1) {
          if (self::MODEL()->pass_verif($formBean->getPassword(), $user[0]->password)) {
            $res->setData(['token' => $user[0]->token]);
            $res->setResponse(self::SUCCESS);
          } else {
            $res->setMessage("Le mot de passe ne correspond pas !");
          }
        } else {
          $res->setMessage("L'utilisateur n'existe pas !");
        }
      }
      return $res;
    }
    
    
    public static function fetch_all_users(): Results
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_all_users());
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public static function fetch_user_by_id(int $id): Results
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_id($id));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public static function fetch_user_by_token(string $token): Results
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_token($token));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public static function fecth_user_by_username(string $username): Results
    {
      $res = self::_results();
      $res->setData(self::MODEL()->get_user_by_token($username));
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public static function switch_actived(int $idUser)
    {
      $res = self::_results();
      self::MODEL()->switch_actived($idUser);
      $res->setResponse(self::SUCCESS);
      return $res;
    }
    
    public static function delete_user(int $idUser)
    {
      $res = self::_results();
      self::MODEL()->delete_user($idUser);
      $res->setResponse(self::SUCCESS);
      return $res;
    }
  }
