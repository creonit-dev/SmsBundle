<?php

namespace Creonit\SmsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('creonit_sms');

        $rootNode
            ->children()
                ->variableNode('provider')->defaultValue('creonit_sms.provider.smstrafic')
                    ->beforeNormalization()
                        ->ifTrue(function ($v) { return is_string($v) && 0 === strpos($v, '@'); })
                        ->then(function ($v) {
                            return substr($v, 1);
                        })
                    ->end()
                ->end()
                ->arrayNode('provider_config')->isRequired()
                    ->prototype('variable')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}