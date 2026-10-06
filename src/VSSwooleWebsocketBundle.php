<?php namespace Vankosoft\SwooleWebsocketBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use Vankosoft\SwooleWebsocketBundle\DependencyInjection\VSSwooleWebsocketExtension;

class VSSwooleWebsocketBundle extends AbstractBundle
{
    public function build( ContainerBuilder $container ): void
    {
        parent::build( $container );
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new VSSwooleWebsocketExtension();
    }
}
