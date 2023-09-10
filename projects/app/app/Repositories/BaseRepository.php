<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

abstract class BaseRepository
{
    protected $base_url;

    public function __construct(string $base_url = 'http://192.168.55.11')
    {
        $this->base_url = $base_url;
    }

    public function get(string $endpoint): object
    {
        try {
            $headers['content-type'] = 'application/json; charset=UTF-8';
            $url = $this->base_url . $endpoint;


            return Http::withHeaders($headers)->withoutVerifying()->get($url);
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage());
        }
    }

    public function post(string $endpoint, array $body = []): object
    {
        try {
            $headers['content-type'] = 'application/json; charset=UTF-8';
            $headers['Accept'] = 'application/json';
            $url = $this->base_url . $endpoint;

            return Http::withHeaders($headers)->withoutVerifying()->post($url, $body);
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage());
        }
    }

    public function put(string $endpoint, array $body = []): object
    {
        try {
            $headers['content-type'] = 'application/json; charset=UTF-8';
            $headers['Accept'] = 'application/json';
            $url = $this->base_url . $endpoint;

            return Http::withHeaders($headers)->withoutVerifying()->put($url, $body);
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage());
        }
    }
}
