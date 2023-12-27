<?php

namespace App\Api;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Igdb
{
    private $access_token = '';
    const CACHE_KEY = 'igdb_acccess_token';
    const IGDB_API_URL = 'https://api.igdb.com/v4/';
    const IGDB_AUTH_URL = 'https://id.twitch.tv/oauth2/token';

    public function __construct()
    {
        $this->access_token = $this->getAccessToken();
    }

    private function getAccessToken(): string
    {
        if ($this->access_token = Cache::get(self::CACHE_KEY)) {
            return $this->access_token;
        }

        try {
            $q = http_build_query([
                'client_id' => config('igdb.client_id'),
                'client_secret' => config('igdb.secret_id'),
                'grant_type' => 'client_credentials'

            ]);

            $r = Http::post(self::IGDB_AUTH_URL . "?" . $q)->throw()->json();
            if (is_array($r) && !empty($r['access_token'])) {
                Cache::put(self::CACHE_KEY, $r['access_token'], (int) $r['expires_in'] - 120);
                $this->access_token = $r['access_token'];
            }
        } catch (Exception $e) {
            Log::error(sprintf("Error optaining key: %s", $e->getMessage()));
        }

        return $this->access_token ?? '';
    }
}
