<?php

$result = Swoole\Async::read(__DIR__."/1.txt", function($filename, $content){
    // echo "filename: $filename".PHP_EOL;
    echo "$content".PHP_EOL;
},10,10);
var_dump($result);
echo "start:".PHP_EOL;