<?php namespace Vankosoft\WebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Vankosoft\WebsocketBundle\Websocket\Server\Server;

class StartEvent extends Event
{
    public const NAME   = 'Start';
    
    public function __construct( public readonly Server $server )
    {
        // Nothing
    }
}