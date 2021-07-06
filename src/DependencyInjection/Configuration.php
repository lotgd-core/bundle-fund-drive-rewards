<?php

/**
 * This file is part of "LoTGD Bundle Fund Drive Rewards".
 *
 * @see https://github.com/lotgd-core/bundle-fund-drive
 *
 * @license https://github.com/lotgd-core/bundle-fund-drive/blob/main/LICENSE
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Lotgd\Bundle\FundDriveRewards\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('lotgd_fund_drive_rewards');

        $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('turns')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultTrue()
                            ->info('Enable/Disable give a extra turns (forest fights)')
                        ->end()
                        ->integerNode('start_percent')
                            ->defaultValue(100)
                            ->min(0)
                            ->info('Percentage at which you start counting for reward')
                        ->end()
                        ->integerNode('block_percent')
                            ->defaultValue(10)
                            ->min(1)
                            ->info('Give 1 turn for each block of #% over the objetive')
                        ->end()
                        ->integerNode('max_allowed')
                            ->defaultValue(10)
                            ->min(1)
                            ->info('Maximum number of turns allowed to be granted')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('healing')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')
                            ->defaultTrue()
                            ->info('Enable/Disable give a healing discount')
                        ->end()
                        ->integerNode('start_percent')
                            ->defaultValue(100)
                            ->min(0)
                            ->info('Percentage at which you start counting for reward')
                        ->end()
                        ->integerNode('block_percent')
                            ->defaultValue(10)
                            ->min(1)
                            ->info('Discount of 1% for each block of #% over the objetive')
                        ->end()
                        ->integerNode('max_allowed')
                            ->defaultValue(10)
                            ->min(1)
                            ->info('Maximum discount of healing allowed to be granted')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
