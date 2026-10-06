<?php namespace Vankosoft\WebsocketBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Swoole\Http\Request;
use Vankosoft\WebsocketBundle\Websocket\Server\Server;

class OpenEvent extends Event
{
    public const NAME   = 'Open';
    
    public function __construct( public readonly Server $server, public readonly Request $request )
    {
        // Nothing
    }
}
