<?php

require_once './src/_config/Commons.php';

class Status extends Commons
{
    public int $status;
    public string $title;
    public string $description;
    public $message;
    public $data;

    /**
     * Status constructor.
     * @param int $status
     * @param string $title
     * @param string $description
     */
    public function __construct(int $status, string $title, string $description)
    {
        $this->status = $status;
        $this->title = $title;
        $this->description = $description;
        $this->message = "$status $title : $description";
    }

    public function throws($message = null, $data = null)
    {
        if ($data != null) $this->data = $data;
        if ($message != null) $this->message = $message;
        self::e_error($this);
    }

}
