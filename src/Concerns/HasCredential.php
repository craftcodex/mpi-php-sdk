<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

trait HasCredential
{
    public function token($token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getToken()
    {
        return $this->token ?: config('mitrapayment.credential.token');
    }

    public function key($key): static
    {
        $this->key = $key;

        return $this;
    }

    public function getKey()
    {
        return $this->key ?: config('mitrapayment.credential.key');
    }
}
