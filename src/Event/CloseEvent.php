<?php namespace Vankosoft\SwooleWebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Vankosoft\SwooleWebsocketBundle\Websocket\Server;

class CloseEvent extends Event
{
    public const NAME   = 'Close';
    
    public function __construct( public readonly Server $server, public readonly int $fd )
    {
        // Nothing
    }
}
