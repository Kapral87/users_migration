<?php

namespace App\Services\Vk;

use Illuminate\Support\Facades\Http;

class Api
{
    const API_VERSION = "5.95";
    const VK_GET_FRIENDS_URL = 'https://api.vk.com/method/friends.get';

    const ERROR_MESSAGE_VK = 'VK error. Code - %d. Message - %s.';

    const UNKNOWN_ERROR_CODE = 0;
    const UNKNOWN_ERROR_MESSAGE = 'Unknown error';

    /**
     * Get friends from VK.
     *
     * @return array
     *
     * @throws \Throwable Error in getting friends from VK
     */
    public function getFriends()
    {
        $params = [
            'user_id' => env('VK_USER_ID'),
            'fields' => 'first_name,last_name,photo_200',
            'access_token' => env('VK_APP_ACCESS_TOKEN'),
            'v' => self::API_VERSION
        ];

        $response = Http::get(self::VK_GET_FRIENDS_URL, $params)->json();

        if (isset($response['error'])) {
            throw new \Exception(sprintf(self::ERROR_MESSAGE_VK, $response['error']['error_code'], $response['error']['error_msg']));
        }

        if (!isset($response['response'])) {
            throw new \Exception(sprintf(self::ERROR_MESSAGE_VK, self::UNKNOWN_ERROR_CODE, self::UNKNOWN_ERROR_MESSAGE));
        }

        return $response['response']['items'] ?? [];
    }
}
