<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ImageUpload::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($album) {
            $album->images()->each(function ($image) {
                $image->delete();
            });
        });
    }
    
}
