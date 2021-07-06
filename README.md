# LoTGD Bunde Fund Drive Rewards

Give rewards to players based on Fund Drive Goal in your LoTGD server.

# Install
```bash
composer require lotgd-core/bundle-fund-drive-rewards
```

# Default config
```yaml
lotgd_fund_drive_rewards:
    turns:
        # Enable/Disable give a extra turns (forest fights)
        enabled: true
        # Percentage at which you start counting for reward
        start_percent: 100
        # Give 1 turn for each block of #% over the objetive
        block_percent: 10
        # Maximum number of turns allowed to be granted
        max_allowed: 10
    healing:
        # Enable/Disable give a healing discount
        enabled: true
        # Percentage at which you start counting for reward
        start_percent: 100
        # Discount of 1% for each block of #% over the objetive
        block_percent: 10
        # Maximum discount of healing allowed to be granted
        max_allowed: 10
```
