<?php

/**
 * This file is part of "LoTGD Bundle Fund Drive".
 *
 * @see https://github.com/lotgd-core/bundle-fund-drive
 *
 * @license https://github.com/lotgd-core/bundle-fund-drive/blob/main/LICENSE
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lotgd\Bundle\FundDriveRewards\EventListener\HealingListener;
use Lotgd\Core\Events;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

return static function (ContainerConfigurator $container)
{
    $container->services()
        ->set(HealingListener::class)
            ->args([
                new ReferenceConfigurator('lotgd_bundle.fund_drive.calculate_tool'),
                new ReferenceConfigurator('translator'),
                new ReferenceConfigurator(FlashBagInterface::class)
            ])
            ->tag('kernel.event_listener', ['event' => Events::PAGE_HEALER_MULTIPLY, 'method' => 'onMultiply'])
    ;
};
