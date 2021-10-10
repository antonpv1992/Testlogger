<?php

namespace MyLogger;

class MyLogger
{

    private $name;
    private $file;
    private $dir;
    private $fp;

    public function __construct($file, $name = 'Log')
    {
        $dirs = explode('/', $file);
        $this->name = $name;
        $this->file = array_pop($dirs);
        $this->dir = $this->createDir($dirs); 
        $this->fp = fopen($this->dir . $this->file, 'a+');
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
        if (is_string($message)) {
            $log = '[' . date('D M d H:i:s Y', time()) . '] ' . $this->name . ' Warning: ' . $message . PHP_EOL;
            echo $log;
            $this->writeLog($log);
        }
    }

    public function error($message)
    {
        if (is_string($message)) {
            $log = '[' . date('D M d H:i:s Y', time()) . '] ' . $this->name . ' Error: ' . $message . PHP_EOL;
            echo $log;
            $this->writeLog($log);
        }
    }

    private function createDir($array)
    {
        $main = "";
        foreach($array as $dir){
            if (!is_dir($main . $dir)){
                mkdir($main . $dir);
            }
            $main .= $dir . '/';
        }
        return $main;
    }
}