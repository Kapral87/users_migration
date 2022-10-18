<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VkUser extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $softDelete = false;

    public $fillable = [
        'vk_id',
        'name',
        'email'
    ];

    protected $casts = [
        'id' => 'integer',
        'vk_id' => 'integer',
        'name' => 'string',
        'email' => 'string'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Set avatar file as single.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }
}
