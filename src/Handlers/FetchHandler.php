<?php

declare(strict_types=1);

namespace WPgraphql\Handlers;
use \GuzzleHttp\Client;

class FetchHandler
{
    public function connect(): void
    {
        $client = new Client();
    }
}
