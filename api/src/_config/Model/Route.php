<?php

class Route
{
    public $name;
    public $method;
    public $class;
    public $function;

    /**
     * @param $name
     * @param $method
     * @param $class
     * @param $function
     */
    public function __construct($name, $method, $arrayFunction)
    {
        $this->name = $name;
        $this->method = $method;
        $this->class = $arrayFunction[0];
        $this->function = $arrayFunction[1];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class): void
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param mixed $function
     */
    public function setFunction($function): void
    {
        $this->function = $function;
    }





}