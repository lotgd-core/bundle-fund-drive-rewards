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

trait Config
{
    private $startPercent;
    private $blockPercent;
    private $maxAllowed;

    public function setStartPercent(int $startPercent): self
    {
        $this->startPercent = $startPercent;

        return $this;
    }

    public function setBlockPercent(int $blockPercent): self
    {
        $this->blockPercent = $blockPercent;

        return $this;
    }

    public function setMaxAllowed(int $maxAllowed): self
    {
        $this->maxAllowed = $maxAllowed;

        return $this;
    }
}
