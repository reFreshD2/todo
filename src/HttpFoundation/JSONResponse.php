<?php

namespace App\HttpFoundation;

class JSONResponse
{
    public static $statusTexts = [
        200 => 'OK',
        404 => 'Not Found',
        422 => 'Unprocessable Entity'
    ];

    protected $content;
    protected $statusCode;

    public function __construct($content, $status)
    {
        $this->content = $content;
        $this->statusCode = $status;
    }

    public function send()
    {
        header("HTTP/1.1 $this->statusCode" . self::$statusText[$this->statusCode],true,$this->statusCode);
        header("Content-type:application/json");
        echo json_encode($this->content);
        return $this;
    }
}