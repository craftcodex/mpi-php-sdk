<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

use Illuminate\Support\Str;
use Throwable;

trait HasSignEncryption
{
    public function referencePrefix($prefix): static
    {
        $this->data['referenceId'] = $prefix.Str::uuid()->toString();

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function getReference()
    {
        return $this->data['referenceId'];
    }

    public function getSignEncryption(): string
    {
        return hash_hmac(
            algo: 'sha512',
            data: $this->getKey().$this->getReference(),
            key: $this->getToken()
        );
    }
}
