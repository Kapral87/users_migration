<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\Vk\Api as VkApi;
use App\Events\VkUserReceived;

class MigrateVkUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:vkusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate users from vk';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $vk_api = new VkApi();
        try {
            $vk_users = $vk_api->getFriends();
            foreach ($vk_users as $vk_user) {
                event(new VkUserReceived($vk_user));
            }
        } catch (\Throwable $e) {
            print_r($e->getMessage() . PHP_EOL);

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
