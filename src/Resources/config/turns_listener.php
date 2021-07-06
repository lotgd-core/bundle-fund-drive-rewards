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

use Lotgd\Bundle\FundDriveRewards\EventListener\TurnsListener;
use Lotgd\Core\Event\Core;

return static function (ContainerConfigurator $container)
{
    $container->services()
        ->set(TurnsListener::class)
            ->args([
                new ReferenceConfigurator('lotgd_bundle.fund_drive.calculate_tool')
            ])
            ->tag('kernel.event_listener', ['event' => Core::NEWDAY, 'method' => 'onNewDay'])
    ;
};
