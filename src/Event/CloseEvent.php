<?php namespace Vankosoft\WebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Vankosoft\WebsocketBundle\Websocket\Server\Server;

class CloseEvent extends Event
{
    public const NAME   = 'Close';
    
    public function __construct( public readonly Server $server, public readonly int $fd )
    {
        // Nothing
    }
}
