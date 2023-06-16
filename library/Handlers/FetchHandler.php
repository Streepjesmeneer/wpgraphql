<?php

declare(strict_types=1);

namespace ProductAPI\Handlers;
use Exception;
use \GuzzleHttp\Client;

class FetchHandler
{
    public static function connect(string $endpoint = ''): ?string
    {
        $app    = $_ENV['APP_URL'] ?? '';
        $client = new Client();

        try {
            $response = $client->get(sprintf('%s/%s', $app, $endpoint));
            $body = (string) $response->getBody();

            return $body;
        } catch(Exception $error) {
            echo sprintf("Error: %s", $error->getMessage());
        }
    }
}
