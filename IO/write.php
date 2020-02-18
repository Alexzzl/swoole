<?php

$content = date("Ymd H:i:s").PHP_EOL;

swoole_async_writefile(__DIR__."/1.log", $content, function($filename){
    echo "success".PHP_EOL;
},FILE_APPEND);

echo "Start:".PHP_EOL;