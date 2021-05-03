<?php
  
  
  abstract class Model
  {
    protected function _date(): string
    {
      date_default_timezone_set('Europe/Paris');
      $date = new DateTime();
      return $date->format('Y-m-d H:i:s');
    }

    protected function generate_user_token(): string
    {
      date_default_timezone_set('Europe/Paris');
      $date = new DateTime();
      return strtoupper(uniqid() . "-" .  $date->format('MmYdD') . '-' . uniqid() ."-" . $date->format('hisAu'). '-' . uniqid());
    }
  
    public function pass_crypt($password)
    {
      return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
  
    public function pass_verif($password, $hash)
    {
      return password_verify($password, $hash);
    }
  }
