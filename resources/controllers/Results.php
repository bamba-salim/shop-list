<?php
  
  
  class Results
  {
    private $message;
    private $response;
    private $data;
    private $nbResults;
    
  
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
      $this->setNbResults($data);
      $this->data = $data;
    }

    public function getNbResults()
    {
      return count($this->data);
    }

    public function setNbResults($nbResults): void
    {
      $this->nbResults = count($nbResults);
    }
  
  
  }
