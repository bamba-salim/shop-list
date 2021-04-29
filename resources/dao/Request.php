<?php
  
  
  class Request
  {
    private $table;
    private $conditions;
    private $colonnes;
    private $join;
    private $data;
    private $values;
    private $complements;
    
    public function create()
    {
      return "INSERT INTO {$this->getTable()} ({$this->getColonnes()}) VALUES ({$this->getValues()})";
    }
    
    public function update()
    {
      return "UPDATE {$this->getTable()} SET {$this->getValues()} {$this->getConditions()}";
    }
    
    public function read()
    {
      return "SELECT {$this->getColonnes()} FROM {$this->getTable()} {$this->getJoin()} {$this->getConditions()} {$this->getComplements()}";
    }
    
    public function delete()
    {
      return "DELETE FROM {$this->getTable()}} WHERE {$this->getConditions()}";
    }
  

    
    
    ########## GETTERS & SETTERS ##########
    
    /**
     * @return mixed
     */
    public function getTable()
    {
      return $this->table;
    }
    
    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
      $this->table = $table;
    }
    
    /**
     * @return mixed
     */
    public function getConditions()
    {
      return empty($this->conditions) ? "" : $this->conditions;
    }
    
    /**
     * @param mixed $conditions
     */
    public function setConditions($conditions)
    {
      $this->conditions = $conditions;
    }
    
    /**
     * @return mixed
     */
    public function getColonnes()
    {
      return empty($this->colonnes) ? "*" : implode(",", $this->colonnes);
    }
    
    /**
     * @param mixed $colonnes
     */
    public function setColonnes($colonnes)
    {
      $this->colonnes = $colonnes;
    }
    
    /**
     * @return mixed
     */
    public function getJoin()
    {
      return empty($this->join) ? "" : implode(" ", $this->join);
    }
    
    /**
     * @param mixed $join
     */
    public function setJoin($join)
    {
      $this->join = $join;
    }
    
    /**
     * @return mixed
     */
    public function getData()
    {
      
      return empty($this->data) ? [] : $this->data;
    }
    
    /**
     * @param mixed $data
     */
    public function setData($data)
    {
      $this->data = $data;
    }
    
    /**
     * @return mixed
     */
    public function getValues()
    {
      return empty($this->values) ? "*" : implode(",", $this->values);
    }
    
    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
      $this->values = $values;
    }
  
    /**
     * @return mixed
     */
    public function getComplements()
    {
      return empty($this->complements) ? "" : implode(",", $this->complements);
    }
  
    /**
     * @param mixed $complements
     */
    public function setComplements($complements)
    {
      $this->complements = $complements;
    }
    
    
  
  }
