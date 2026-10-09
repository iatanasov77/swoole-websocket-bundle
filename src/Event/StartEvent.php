<?php namespace Vankosoft\WebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class StartEvent extends Event
{
    public const NAME   = 'Start';
    
    public function __construct( public readonly Server $server, public readonly Frame $frame )
    {
        // Nothing
    }
}