<?php

namespace App\Api;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GameLookupService
{
    private $access_token = '';
    const CACHE_KEY = 'game_lookup_acccess_token';
    const API_URL = 'https://api.igdb.com/v4/';
    const AUTH_URL = 'https://id.twitch.tv/oauth2/token';

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
            $data = [
                'client_id' => config('igdb.client_id'),
                'client_secret' => config('igdb.secret_id'),
                'grant_type' => 'client_credentials'

            ];

            $r = Http::post(self::AUTH_URL, $data)->throw()->json();
            if (is_array($r) && !empty($r['access_token'])) {
                Cache::put(self::CACHE_KEY, $r['access_token'], (int) $r['expires_in'] - 120);
                $this->access_token = $r['access_token'];
            }
        } catch (Exception $e) {
            Log::error(sprintf("Error optaining key: %s", $e->getMessage()));
        }

        return $this->access_token ?? '';
    }


    public function getGameData(string $search)
    {
        $err = "Error loading Game Data";
        try {
            $r = Http::withHeader('Client-ID', config('igdb.client_id'))
                ->withToken($this->access_token)
                ->withBody(sprintf('search "%s";fields *, platforms.*, cover.*; where version_parent = null;', $search))
                ->acceptJson()
                ->post(self::API_URL . 'games')
                ->throw()
                ->json();
        } catch (Exception $e) {
            Log::error($e);
            throw new Exception($err);
        }

        if (!is_array($r)) {
            Log::error("Non Array response from getGameData API call");
            throw new Exception($err);
        }

        return $r;
    }
}
