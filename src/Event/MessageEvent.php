<?php namespace Vankosoft\SwooleWebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Swoole\WebSocket\Frame;
use Vankosoft\SwooleWebsocketBundle\Websocket\Server;

class MessageEvent extends Event
{
    public const NAME   = 'Message';
    
    public function __construct( public readonly Server $server, public readonly Frame $frame )
    {
        // Nothing
    }
}
