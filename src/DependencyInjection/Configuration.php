<?php namespace Vankosoft\SwooleWebsocketBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder    = new TreeBuilder( 'vs_websocket' );
        $rootNode       = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode( 'document_root' )
                    ->defaultValue( '/public' )->cannotBeEmpty()
                ->end()
                
                ->booleanNode( 'exeption_trace' )
                    ->defaultFalse()
                ->end()
            ->end()
        ;
        
        return $treeBuilder;
    }
}
