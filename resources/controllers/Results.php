<?php
  
  
  class Results
  {
    public $message;
    public $response;
    public $data;
    public $nbResults;
    
    
    /**
     * @return mixed
     */
    public function getMessage()
    {
      return $this->message;
    }
    
    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
      $this->message = $message;
    }
    
    /**
     * @return mixed
     */
    public function getResponse()
    {
      return $this->response;
    }
    
    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
      $this->response = $response;
    }
    
    /**
     * @return mixed
     */
    public function getData()
    {
      return $this->data;
    }
    
    public function setData($data): void
    {
      $this->data = $data;
      $this->setNbResults($data);
  
    }
    
    public function getNbResults()
    {
      return $this->nbResults;
    }
    
    public function setNbResults($data): void
    {
//      var_dump(gettype($data));
      switch (gettype($data)) {
        case "array":
          $this->nbResults = count($data);
          break;
        case 'string';
          $this->nbResults = 1;
          break;
        case null;
          $this->nbResults = 0;
          break;
        default:
          $this->nbResults = 0;
        
      }
    }
    
    
  }
