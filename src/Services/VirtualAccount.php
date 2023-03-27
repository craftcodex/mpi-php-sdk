<?php

namespace CraftCodex\MpiPhpSdk\Services;

use CraftCodex\MpiPhpSdk\MpiPhpSdk;
use Exception;
use Throwable;

class VirtualAccount extends MpiPhpSdk
{
    /**
     * @var array{
     * key: string,
     * token: string,
     * referenceId: string,
     * amount: string,
     * callbackUrl: string,
     * signHash: string,
     * reqType: string,
     * viewName: string,
     * expTime: string,
     * useCase: string,
     * vaExpired: string,
     * }
     */
    protected array $data = [
        'reqType' => 'oneoff',
        'useCase' => 'single',
        'expTime' => 60,
        'vaExpired' => 60,
    ];

    /**
     * Selected bank
     *
     * @var string
     */
    protected string $bank;

    /**
     * All virtual account accepted banks
     *
     * @return string[]
     */
    public static function getAcceptedBanks(): array
    {
        return [
            'va_bca' => 'Virtual Account BCA',
            'va_permata' => 'Virtual Account Pertama',
            'va_mandiri' => 'Virtual Account Mandiri',
            'va_bri' => 'Virtual Account BRI',
        ];
    }

    /**
     * Static make functions
     *
     * @throws Throwable
     */
    public static function make($bank = '', $username = '', $apiKey = ''): static
    {
        $static = parent::make($username, $apiKey);
        $static->bank($bank);

        return $static;
    }

    /**
     * Set virtual account expiration time in minutes, default is 60 minutes
     *
     * @param int $minutes
     * @return $this
     */
    public function expiredIn(int $minutes): static
    {
        $this->data['expTime'] = $minutes;
        $this->data['vaExpired'] = $minutes;

        return $this;
    }

    /**
     * Get full url of endpoint api
     */
    public function getPath(): string
    {
        return '/va/' . $this->bank;
    }

    /**
     * Set virtual account display name
     *
     * @param $viewName
     * @return $this
     */
    public function displayName($viewName): static
    {
        $this->data['viewName'] = $viewName;

        return $this;
    }

    /**
     * Set bank virtual account
     *
     * @throws Throwable
     */
    public function bank(string $bank): static
    {
        throw_if(
            condition: !collect(self::getAcceptedBanks())->has($bank),
            exception: new Exception('Bank code not found')
        );

        $this->bank = $bank;

        return $this;
    }

    /**
     * Set virtual account bill amount
     *
     * @param $amount
     * @return $this
     */
    public function amount($amount): static
    {
        $this->data['amount'] = $amount;

        return $this;
    }

    /**
     * Set request type to OneOff
     *
     * @return $this
     */
    public function oneOffRequest()
    {
        $this->data['reqType'] = 'oneoff';

        return $this;
    }

    /**
     * Set request type to persistent
     *
     * @return $this
     */
    public function persistentRequest()
    {
        $this->data['reqType'] = 'persistent';

        return $this;
    }
}
