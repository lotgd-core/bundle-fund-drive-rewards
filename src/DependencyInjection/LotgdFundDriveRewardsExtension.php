<?php

/**
 * This file is part of "LoTGD Bundle Fund Drive Rewards".
 *
 * @see https://github.com/lotgd-core/bundle-fund-drive-rewards
 *
 * @license https://github.com/lotgd-core/bundle-fund-drive-rewards/blob/main/LICENSE
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Lotgd\Bundle\FundDriveRewards\DependencyInjection;

use Lotgd\Bundle\FundDriveRewards\EventListener\HealingListener;
use Lotgd\Bundle\FundDriveRewards\EventListener\TurnsListener;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class LotgdFundDriveRewardsExtension extends ConfigurableExtension
{
    public function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        if ($mergedConfig['turns']['enabled'])
        {
            $loader->load('turns_listener.php');

            $container->getDefinition(TurnsListener::class)
                ->addMethodCall('setStartPercent', [$mergedConfig['turns']['start_percent']])
                ->addMethodCall('setBlockPercent', [$mergedConfig['turns']['block_percent']])
                ->addMethodCall('setMaxAllowed', [$mergedConfig['turns']['max_allowed']])
            ;
        }

        if ($mergedConfig['healing']['enabled'])
        {
            $loader->load('healing_listener.php');

            $container->getDefinition(HealingListener::class)
                ->addMethodCall('setStartPercent', [$mergedConfig['healing']['start_percent']])
                ->addMethodCall('setBlockPercent', [$mergedConfig['healing']['block_percent']])
                ->addMethodCall('setMaxAllowed', [$mergedConfig['healing']['max_allowed']])
            ;
        }
    }
}
