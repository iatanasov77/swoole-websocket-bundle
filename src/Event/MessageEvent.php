<?php namespace Vankosoft\WebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Swoole\WebSocket\Frame;
use Vankosoft\WebsocketBundle\Websocket\Server\Server;

class MessageEvent extends Event
{
    public const NAME   = 'Message';
    
    public function __construct( public readonly Server $server, public readonly Frame $frame )
    {
        // Nothing
    }
}
