<?php

Class WsObject {
    CONST HOST = "0.0.0.0";
    CONST PORT = 8812;

    public $ws = null;
    
    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server("0.0.0.0", 8812);

        $this->ws->on("open", [$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("close", [$this, 'onClose']);

        $this->ws->start();
    }

    // Listen WebSocket connecting
    public function onOpen($ws, $request)
    {
        if($request->fd == 1) {
            Swoole\Timer::tick(2000, function($timer_id){
                echo "2s: timerId: {$timer_id}\n";
            });
        }
        echo "server: handshake success with fd{$request->fd}\n";
    }

    // Listen WebSocket Message
    public function onMessage($ws, $frame)
    {
        Swoole\Timer::after(5000, function() use ($ws, $frame){
           echo "5s after:\n";
           echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
           $ws->push($frame->fd, "5s after server push:".date("Y-m-d H:i:s"));
        });
        $ws->push($frame->fd, "this is alex push server, time:".date("Y-m-d H:i:s"));

        
        
    }

    // close
    public function onClose($ws, $fd)
    {
        echo "client {$fd} closed\n";
    }
}

$obj = new WsObject();
