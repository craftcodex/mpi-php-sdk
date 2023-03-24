<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

trait HasData
{
    protected array $data = [];

    /**
     * Set http body
     *
     * @param $data = self::$data
     * @return $this
     */
    public function data($data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get http body
     *
     * @return array
     * @throws \Throwable
     */
    public function getData(): array
    {
        return array_merge(
            [
                'key' => $this->getKey(),
                'token' => $this->getToken(),
                'referenceId' => $this->getReference(),
                'signHash' => $this->getSignEncryption(),
                'callbackUrl' => $this->getCallbackUrl(false)
            ],
            $this->data
        );
    }
}
