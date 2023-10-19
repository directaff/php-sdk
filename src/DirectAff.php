<?php

namespace DirectAff;

use DirectAff\Abstracts\Base;

class DirectAff extends Base
{

    /**
     * Player registration
     * @param array $params ['clickId', 'registration_date']
     * @return array
     */
    public function register(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['username'], $params['registration_date'])) {
            throw new \InvalidArgumentException("Required parameters for registration are missing.");
        }

        return $this->makeApiPostRequest($params);
    }


    /**
     * Player deposit
     * @param array $params ['clickId', 'amount', 'currency', 'deposit_id', 'transaction_date']
     * @return array
     */
    public function deposit(array $params): array
    {

        if (!isset($params['clickId'], $params['amount'], $params['currency'], $params['depositId'], $params['transactionDate'])) {
            throw new \InvalidArgumentException("Required parameters for deposit are missing.");
        }

        return $this->makeApiPostRequest($params);
    }


    /**
     *  Player withdraw
     * @param array $params ['clickId', 'amount', 'currency', 'withdraw_id', 'transaction_date']
     * @return array
     */
    public function withdraw(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['amount'], $params['currency'], $params['withdrawId'], $params['transactionDate'])) {
            throw new \InvalidArgumentException("Required parameters for withdraw are missing.");
        }

        return $this->makeApiPostRequest($params);
    }

    /**
     * Bonus added
     * @param array $params ['clickId', 'amount', 'currency', 'bonus_id', 'transaction_date']
     * @return array
     */
    public function bonusAdded(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['amount'], $params['currency'], $params['bonusId'], $params['transactionDate'])) {
            throw new \InvalidArgumentException("Required parameters for bonus are missing.");
        }

        return $this->makeApiPostRequest($params);
    }


    /**
     * Bonus removed
     * @param array $params ['clickId', 'amount', 'currency', 'bonus_id', 'transaction_date']
     * @return array
     */
    public function bonusRemoved(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['amount'], $params['currency'], $params['bonusId'], $params['transactionDate'])) {
            throw new \InvalidArgumentException("Required parameters for bonus are missing.");
        }

        return $this->makeApiPostRequest($params);
    }


    /**
     * chargeback
     * @param array $params ['clickId', 'amount', 'currency', 'chargeback_id', 'transaction_date']
     * @return array
     */
    public function chargeback(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['amount'], $params['currency'], $params['chargebackId'], $params['transactionDate'])) {
            throw new \InvalidArgumentException("Required parameters for chargeback are missing.");
        }

        return $this->makeApiPostRequest($params);
    }


    /**
     * bet and win
     * @param array $params ['clickId', 'bet_amount', 'win_amount', 'currency']
     * @return array
     */
    public function betWin(array $params): array
    {
        // Validate $params inside the method
        if (!isset($params['clickId'], $params['betAmount'], $params['winAmount'], $params['currency'])) {
            throw new \InvalidArgumentException("Required parameters for bet and win are missing.");
        }
        return $this->makeApiPostRequest($params);
    }

}
