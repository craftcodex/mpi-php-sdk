<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

trait HasEndpoint
{
    protected ?string $path;

    protected ?string $host = 'https://api-prod.mitrapayment.com/api/v4';

    /**
     * Set Path
     *
     * @return $this
     */
    public function path($path): static
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get api path
     */
    public function getPath(): string
    {
        return str($this->path)->startsWith('/');
    }

    /**
     * Set api host
     *
     * @return $this
     */
    public function host($host): static
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get api host
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Get full url of endpoint api
     */
    public function getUrl(): string
    {
        return $this->getHost().$this->getPath();
    }
}
