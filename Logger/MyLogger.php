<?php

namespace Logger;

class MyLogger
{

    private $name;
    private $file;
    private $fp;

    public function __construct($file, $name = 'Log')
    {
        $this->name = $name;
        $this->file = $file;
        //if(is_file($file) || $file == null) {
            $this->fp = fopen($file, 'a+');
        //} 
    }

    protected function writeLog($string)
    {
        fwrite($this->fp, $string);
    }
 
    public function __destruct()
    {
        fclose($this->fp);
    }


    public function warning($message)
    {
        if(is_string($message)) {
            $log = '[' . date('D M d H:i:s Y', time()) . '] ' . $this->name . ' Warning: ' . $message . PHP_EOL;
            echo $log;
            $this->writeLog($log);
        }
    }

    public function error($message)
    {
        if(is_string($message)) {
            $log = '[' . date('D M d H:i:s Y', time()) . '] ' . $this->name . ' Error: ' . $message . PHP_EOL;
            echo $log;
            $this->writeLog($log);
        }
    }
}