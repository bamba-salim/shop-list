<?php
  
  abstract class Controllers
  {
    protected const SUCCESS = 'success';
    protected const ERROR = 'error';
    
    public static function set_js_token($token)
    {
      print("<script type='text/javascript'>
              localStorage.setItem('u_t','{$token}');
              localStorage.removeItem('log_error');
            </script>");
    }
    
    public static function set_js_error($error)
    {
      print("<script type='text/javascript'>
              localStorage.setItem('log_error','{$error}');
            </script>");
    }
  }
