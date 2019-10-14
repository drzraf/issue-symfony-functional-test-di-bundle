<?php


namespace MyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Reference;

use MyBundle\Service\ExpressionOverride;

class MyExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        if ($container->getParameter('kernel.environment') !== 'test') {
            $loader->load('services.yaml');
        } else {
            $loader->load('services_test.yaml');
        }

        $this->addAnnotatedClassesToCompile([
          // you can define the fully qualified class names...
          'MyBundle\\Controller\\',
          'MyBundle\\DestinationDriver\\',
          'MyBundle\\Service\\',
        ]);

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Pass overrides as the first argument of the ExpressionOverride service
        $definition = $container->getDefinition(ExpressionOverride::class);
        $definition->setArgument(0, $config['destination_overrides']);
        $container->setDefinition('my_bundle.dest_override', $definition);

    }
}
