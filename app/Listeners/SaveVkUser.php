<?php

namespace App\Listeners;

use App\Events\VkUserReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\VkUser;

class SaveVkUser
{
    const AVATAR_FILE_NAME_POSTFIX = 'avatar';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VkUserReceived  $event
     * @return void
     */
    public function handle(VkUserReceived $event)
    {
        $user_info = $event->vk_user;

        $saved_vk_user = VkUser::updateOrCreate(
            [
                'vk_id' => intval($user_info['id']),
            ],
            [
                'name' => implode(' ', [$user_info['first_name'], $user_info['last_name']]),
            ]
        );
        $saved_vk_user->addMediaFromUrl($user_info['photo_200'])->usingFileName(
            $saved_vk_user->id .
            '_' .
            self::AVATAR_FILE_NAME_POSTFIX .
            '.' .
            \File::extension(parse_url($user_info['photo_200'], PHP_URL_PATH))
        )->toMediaCollection('avatar');
    }
}
