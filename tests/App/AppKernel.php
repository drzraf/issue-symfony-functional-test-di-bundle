<?php

namespace MyBundle\Tests\App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class AppKernel extends BaseKernel
{
    use MicroKernelTrait;

    const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function getCacheDir()
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir()
    {
        return $this->getProjectDir() . '/var/log';
    }

    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            /*
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new \Symfony\Bundle\MakerBundle\MakerBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            */
            new \MyBundle\MyBundle()
        ];
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $container->loadFromExtension('framework', [
            'secret' => 'S0ME_SECRET'
        ]);

        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir() . '/Resources/config';
        if (is_dir($confDir . '/packages/' . $this->environment)) {
            $loader->load($confDir . '/packages/' . $this->environment . '/**/*' . self::CONFIG_EXTS, 'glob');
        }
        $loader->load(__DIR__ . '/services' . self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
    }
}
