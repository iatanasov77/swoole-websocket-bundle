<?php namespace Vankosoft\SwooleWebsocketBundle\Websocket;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use SplObjectStorage as SplObjectStorageAlias;

use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebsocketServer;
use Vankosoft\ApplicationBundle\Component\MyLoggerInterface;

class ServerHandler implements ServerHandlerInterface
{
    /** @var MyLoggerInterface */
    private $logger;
    
    /** @var SerializerInterface */
    private $serializer;
    
    /** @var \SplObjectStorage */
    private $clients;
    
    /** @var int */
    private $connectionSequenceId = 0;
    
    /** @var array */
    private $names;
    
    /** @var array */
    private $games;
    
    /** @var bool */
    private $logExceptionTrace;
    
    public function __construct(
        MyLoggerInterface $logger,
        SerializerInterface $serializer,
        bool $logExceptionTrace
    ) {
        $this->logger           = $logger;
        $this->serializer       = $serializer;
        
        $this->clients  = new SplObjectStorageAlias();
        $this->names    = [];
        $this->games    = [];
        
        $this->logExceptionTrace    = $logExceptionTrace;
    }
    
    public function onOpen( WebsocketServer $server, Request $request ): void
    {
        $this->logger->log( "Swoole Server Call Subscriber onOpened !!!" );
    }
    
    public function onMessage( WebsocketServer $server, Frame $frame ): void
    {
        $this->logger->log( "Swoole Server Call Subscriber onMessage: {$frame->data}" );
        
        $server->push( $frame->fd, \json_encode( ["hello", time()] ) );
    }
    
    public function onClose( WebsocketServer $server, int $fd ): void
    {
        $this->logger->log( "Swoole Server Call Subscriber onClose !!!" );
    }
}
