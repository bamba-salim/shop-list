<?php
  
  abstract class Controllers
  {
    protected const SUCCESS = 'success';
    protected const ERROR = 'error';
  
    public function json_response($data=null, $httpStatus=200)
    {
      header_remove();
    
      header("Content-Type: application/json");
    
      http_response_code($httpStatus);
    
      echo json_encode($data);
    
      exit();
    }
  }
