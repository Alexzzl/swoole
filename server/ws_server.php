<?php

$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);

// $server->set([
//     "enable_static_handler" => true,
//     "document_root" => "/home/alex/study/swoole/data",
// ]);

$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is alex push server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();