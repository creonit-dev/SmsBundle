<?php

namespace Creonit\SmsBundle\DependencyInjection;

use Creonit\SmsBundle\Transport\SmsTransportInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class CreonitSmsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setAlias(SmsTransportInterface::class, $this->createTransport($container, $config));
    }

    protected function createTransport(ContainerBuilder $container, array $config)
    {
        $transport = new ChildDefinition($config['transport']);
        $transport->addMethodCall('init', [$config['transport_config']]);

        $container->setDefinition('creonit.sms.transport', $transport);

        return 'creonit.sms.transport';
    }
}
