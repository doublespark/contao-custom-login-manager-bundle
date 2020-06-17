<?php

declare(strict_types=1);

namespace Doublespark\ContaoCustomLoginManagerBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Doublespark\ContaoCustomLoginManagerBundle\DoublesparkContaoCustomLoginManagerBundle;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(DoublesparkContaoCustomLoginManagerBundle::class)->setLoadAfter([ContaoCoreBundle::class])
        ];
    }

    /**
     * @param LoaderResolverInterface $resolver
     * @param KernelInterface $kernel
     * @return mixed
     * @throws \Exception
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        $file = '@DoublesparkContaoCustomLoginManagerBundle/Resources/config/routing.yml';

        return $resolver->resolve($file)->load($file);
    }
}
