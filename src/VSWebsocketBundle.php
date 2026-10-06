<?php namespace Vankosoft\WebsocketBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use Vankosoft\WebsocketBundle\DependencyInjection\VSWebsocketExtension;

class VSWebsocketBundle extends AbstractBundle
{
    public function build( ContainerBuilder $container ): void
    {
        parent::build( $container );
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new VSWebsocketExtension();
    }
}
