<?php namespace Vankosoft\SwooleWebsocketBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Vankosoft\ApplicationBundle\Component\MyLoggerInterface;
use Vankosoft\SwooleWebsocketBundle\Runtime\Runtime;
use Vankosoft\SwooleWebsocketBundle\Websocket\Server;
use Vankosoft\SwooleWebsocketBundle\Websocket\ServerHandlerInterface;

#[AsCommand(
    name: 'vankosoft:swoole-websocket:server',
    description: 'Start Swoole WebSocket Server',
    hidden: false
)]
final class WebsocketServerCommand extends Command
{
    /** @var MyLoggerInterface */
    private $websocketLogger;
    
    /** @var string */
    private $documentRoot;
    
    /** @var array */
    private $runtimeOption = [
        // 'socketio' => true,
        'host' => '0.0.0.0',
        'port' => 8000,
        'mode' => SWOOLE_PROCESS,
        'settings' => [],
    ];
    
    /** @var ServerHandlerInteface */
    private $serverHandler;
    
    public function __construct(
        MyLoggerInterface $websocketLogger,
        string $documentRoot,
        ServerHandlerInterface $serverHandler
    ) {
        parent::__construct();
        
        $this->websocketLogger  = $websocketLogger;
        $this->documentRoot     = $documentRoot;
        
        $workerNum = \swoole_cpu_num() * 2;
        $this->runtimeOption['settings'] = [
            \Swoole\Constant::OPTION_WORKER_NUM => $workerNum,
            \Swoole\Constant::OPTION_ENABLE_STATIC_HANDLER => true,
            \Swoole\Constant::OPTION_DOCUMENT_ROOT => $this->documentRoot,
        ];
        
        $this->serverHandler = $serverHandler;
    }
    
    public function sigHandler( $signo )
    {
        /**
         * @NOTE POSSIX SIGNAL CODES: https://www.php.net/manual/en/pcntl.constants.php#115603
         */
        switch ( $signo ) {
            case SIGTERM:
                $this->serverHandler->serverWasTerminated();
                exit;
                break;
            case SIGHUP:
                // handle restart tasks
                break;
            default:
                // handle all other signals
        }
    }

    public function configure()
    {
        $this->setHelp('Websocket Server')
            ->addOption( 'host', '', InputOption::VALUE_OPTIONAL, 'Host',  '127.0.0.1' )
            ->addOption( 'port', '', InputOption::VALUE_OPTIONAL, 'Port', 8000 )
        ;
    }

    public function run( InputInterface $input, OutputInterface $output ): int
    {
        \pcntl_signal( SIGTERM, array( $this, 'sigHandler' ) );
        \pcntl_signal( SIGHUP, array( $this, 'sigHandler' ) );
        
        $options = ['host' => $input->getOption( 'host' ), 'port' => $input->getOption( 'port' )];
        $options = \array_replace_recursive( $this->runtimeOption, $options );
        
        $server = new Server( $this->websocketLogger, $options );
        $server->setHandler( $this->serverHandler );
        
        $server->init();
        $server->on( 'Start', function () use ( $output, $server ) {
            $output->writeln( "Websocket is now listening in {$server->getServer()->host}: {$server->getServer()->port}" );
        });
        $server->setEvent();
        $this->server = $server;
        $server->start();
        
        return Command::SUCCESS;
    }
}
