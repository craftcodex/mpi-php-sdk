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
    ];

    protected string $bank;

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
     * @throws Throwable
     */
    public static function make($bank = '', $username = '', $apiKey = ''): static
    {
        $static = parent::make($username, $apiKey);
        $static->bank($bank);

        return $static;
    }

    public function expiredIn(int $minutes): static
    {
        $this->data['expTime'] = $minutes;
        $this->data['vaExpired'] = $minutes;

        return $this;
    }

    public function getPath(): string
    {
        return '/va/'.$this->bank;
    }

    public function displayName($viewName): static
    {
        $this->data['viewName'] = $viewName;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function bank(string $bank): static
    {
        throw_if(
            condition: ! collect(self::getAcceptedBanks())->has($bank),
            exception: new Exception('Bank code not found')
        );

        $this->bank = $bank;

        return $this;
    }

    public function amount($amount): static
    {
        $this->data['amount'] = $amount;

        return $this;
    }
}
