<?php

$http = new Swoole\Http\Server("0.0.0.0", 8811);

$http->set([
    "enable_static_handler" => true,
    "document_root" => "/home/alex/study/swoole/data",
]);
$http->on('request', function($request, $response){
    // print_r($request->get);
    $content = [
        'date'=> date('Y-m-d H:i:s'),
        'get'=>$request->get,
        'post'=>$request->post,
        'header'=>$request->header,
    ];
    swoole_async_writefile(__DIR__."/access.log",json_encode($content),
    function($filename){
        // todo
    }, FILE_APPEND);
    $response->cookie("Alex","hhhh",time() + 1800);
    $response->end(json_encode($request->get));
});

$http->start();