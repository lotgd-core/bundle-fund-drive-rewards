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

namespace Lotgd\Bundle\FundDriveRewards\EventListener;

use Lotgd\Bundle\FundDrive\Tool\Calculate;
use Lotgd\Core\Event\Core;

class TurnsListener
{
    use Config;

    private $fundDrive;

    public function __construct(Calculate $fundDrive)
    {
        $this->fundDrive = $fundDrive;
    }

    public function onNewDay(Core $event): void
    {
        global $session;

        $args     = $event->getData();
        $progress = $this->fundDrive->progress();
        $percent  = $progress['percent'] * 100;

        $params = [
            'translation_domain' => 'bundle_fund_drive_rewards',
            //-- Yes this is old module system functions, but stamina system not are as bundle
            'stamina_system' => (bool) is_module_active('staminasystem'),
            'start_percent'  => $this->startPercent,
            'block_percent'  => $this->blockPercent,
            'max_allowed'    => $this->maxAllowed,
            'added_turns'    => 0,
        ];

        if ($percent >= $this->startPercent)
        {
            $blocks                = (int) floor(($percent - 100) / $this->blockPercent);
            $turns                 = min($blocks, $this->maxAllowed);
            $params['added_turns'] = $turns;

            if ($params['added_turns'] > 0)
            {
                if ($params['stamina_system'])
                {
                    require_once 'modules/staminasystem/lib/lib.php';

                    $stamina = $params['added_turns'] * 25000;
                    $args['turnstoday'] .= ", LotgdFundDriveRewards: Stamina {$stamina}";

                    addstamina($stamina);
                }
                else
                {
                    $session['user']['turns'] += $params['added_turns'];
                    $args['turnstoday'] .= ", LotgdFundDriveRewards: Turns {$params['added_turns']}";
                }
            }
        }

        $args['includeTemplatesPost']['@LotgdFundDriveRewards/fund_drive_rewards_newday.html.twig'] = $params;

        $event->setData($args);
    }
}
