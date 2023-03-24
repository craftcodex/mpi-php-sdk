<?php

namespace CraftCodex\MpiPhpSdk\Concerns;

trait HasCallbackUrl
{
    protected ?string $callbackUrl;

    public function callbackUrl(string $callbackUrl): static
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    public function getCallbackUrl($absolute = false)
    {
        $url = $this->callbackUrl ?? config('mitrapayment.callback_url');

        if ($absolute) {
            return $url;
        }

        return url($url);
    }
}
