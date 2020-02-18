<?php

$serv = new swoole_server("127.0.0.1", 9501);

$serv->set([
    'worker_num' => 4, // worker cpu 1-4
    'max_requert' => 10000,
]);

$serv->on('connect', function($serv, $fd, $reactor_id){
    echo "Client: {$reactor_id} - {$fd}-Connect.\n";
}); 

$serv->on('receive', function($serv, $fd, $reactor_id, $data){
    $serv->send($fd, "Server: {$reactor_id} - {$fd}:\n$data\n");
}); 

$serv->on('close', function ($serv, $fd){
    echo "Client: Close.\n";
});

$serv->start();

