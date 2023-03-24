<?php

namespace CraftCodex\MpiPhpSdk;

use CraftCodex\MpiPhpSdk\Constants\Method;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class MpiPhpSdk
{
    use Concerns\HasCredential;
    use Concerns\HasHeader;
    use Concerns\HasEndpoint;
    use Concerns\HasData;
    use Concerns\HasSignEncryption;
    use Concerns\HasCallbackUrl;

    protected ?string $token = null;

    protected ?string $key = null;

    protected string $method = Method::POST;

    final public function __construct($token = null, $key = null)
    {
        $this->token = $token;
        $this->key = $key;
    }

    public static function make($key = null, $token = null): static
    {
        return new static($key, $token);
    }

    public function send(): PromiseInterface|Response
    {
        $request = Http::withHeaders($this->getHeaders())
            ->connectTimeout(40)
            ->withoutVerifying();

        if ($this->method == Method::POST) {
            return $request->post(
                url: $this->getUrl(),
                data: $this->getData()
            );
        }

        return $request->get(url: $this->getUrl(), query: http_build_query($this->getData()));
    }
}
