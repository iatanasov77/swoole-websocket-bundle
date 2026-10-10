<?php namespace Vankosoft\WebsocketBundle\Websocket\Client;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Swoole\WebSocket\Server as WebsocketServer;

final class WebsocketSwooleClient extends AbstractWebsocketClient
{
    /** @var WebsocketServer */
    private $connection;
    
    public function __construct( string $websocketUrl, SerializerInterface $serializer, WebsocketServer $connection )
    {
        parent::__construct( $websocketUrl, $serializer );
        
        $this->connection   = $connection;
    }
    
    public function send( object $msg ): void
    {
        // , [JsonEncode::OPTIONS => JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT]
        $json   = $this->serializer->serialize( $msg, JsonEncoder::FORMAT );
        
        $this->connection->send( $json );
        // $this->connection->push( $this->clientId, \json_encode( ["hello", time()] ) );
    }
    
    public function receive(): string
    {
        return '';
    }
    
    public function close( int $code ): void
    {
        $this->connection->close( $code );
    }
    
    public function subscribe( string $realm, string $topic, \Closure $callback ): void
    {
        
    }
}
