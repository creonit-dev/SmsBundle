<?php

namespace Creonit\SmsBundle\DependencyInjection;

use Creonit\SmsBundle\Transport\LoggerTransport;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('creonit_sms');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('transport')->defaultValue(LoggerTransport::class)
                    ->beforeNormalization()
                        ->ifTrue(function ($v) { return is_string($v) && 0 === strpos($v, '@'); })
                        ->then(function ($v) {
                            return substr($v, 1);
                        })
                    ->end()
                ->end()
                ->arrayNode('transport_config')
                    ->prototype('variable')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
