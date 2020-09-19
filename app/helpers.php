<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;

if (! function_exists('get_current_api')) {
    function get_current_api()
    {
        if (auth()->user()) {
            return auth()->user()->api;
        } else {
            return guess_api_from_session();
        }
    }
}

if (! function_exists('guess_api_from_session')) {
    function guess_api_from_session()
    {
        try {
            $sessionId = request()->session()->getId();
        } catch (\Exception $e) {
            return User::SETTING_API_MAINNET;
        }

        $cacheKey = $sessionId.'-preferred-api';
        $preferredAPI = Cache::get($cacheKey);

        if ($preferredAPI) {
            return $preferredAPI;
        }

        return User::SETTING_API_MAINNET;
    }
}

if (! function_exists('set_api_for_session')) {
    function set_api_for_session($api)
    {
        try {
            $sessionId = request()->session()->getId();
        } catch (\Exception $e) {
            return;
        }

        $cacheKey = $sessionId.'-preferred-api';
        Cache::set($cacheKey, $api);
    }
}
