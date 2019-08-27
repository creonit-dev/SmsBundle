<?php


namespace Creonit\SmsBundle\DependencyInjection;


use Creonit\SmsBundle\SmsManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class CreonitSmsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $providerId = $config['provider'];

        $manager = $container->register('creonit_sms', SmsManager::class);
        $manager->setPublic(true);
        $manager->addArgument(new Reference($providerId));
        $manager->addArgument($config['provider_config']);
    }
}