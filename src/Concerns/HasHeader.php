<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

trait HasHeader
{
    protected array $headers = [
        'Accept' => 'application/json',
        'user-agent' => 'mpi-php-sdk/1.0.0'
    ];

    /**
     * Get request header
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set http headers
     *
     * @param $headers
     * @return $this
     */
    public function headers($headers): static
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }
}
