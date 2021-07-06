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
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class HealingListener
{
    use Config;

    private $translator;
    private $fundDrive;
    private $flash;

    public function __construct(Calculate $fundDrive, TranslatorInterface $translator, FlashBagInterface $flash)
    {
        $this->translator = $translator;
        $this->fundDrive  = $fundDrive;
        $this->flash      = $flash;
    }

    public function onMultiply(GenericEvent $event): void
    {
        $translationDomain = 'bundle_fund_drive_rewards';

        $progress = $this->fundDrive->progress();

        $percent = $progress['percent'] * 100;

        $params = [
            'translation_domain' => $translationDomain,
            'start_percent'      => $this->startPercent,
            'block_percent'      => $this->blockPercent,
            'max_allowed'        => $this->maxAllowed,
        ];

        $this->flash->add('info', $this->translator->trans('flash.message.heal.info', $params, $translationDomain));

        //-- If progress is less than start percent avoid proccess
        if ($percent < $this->startPercent)
        {
            return;
        }

        $blocks   = (int) floor(($percent - 100) / $this->blockPercent);
        $discount = min($blocks, $this->maxAllowed);

        $params['discount'] = $discount;

        $this->flash->add('success', $this->translator->trans('flash.message.heal.result', $params, $translationDomain));

        $event['alterpct'] = $event['alterpct'] * ((100 - $discount) / 100);
    }
}
