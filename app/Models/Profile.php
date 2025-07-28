<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
      protected $casts = [
        'birthdate' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'looking_for_type' => 'array',
        'looking_for_gender' => 'array',
    ];
    protected $fillable = [
        'user_id',
        'name',
        'profile_image',
        'bio',
        'gender',
        'birthdate',
        'location_name',
        'latitude',
        'longitude',
        'looking_for_type',
        'looking_for_gender',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function galleryImages()
    // {
    //     return $this->hasMany(GalleryImage::class);
    // }

}
