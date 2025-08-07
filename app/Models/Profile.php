<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    /**
     * The attributes that should be cast to native types. This helps with type safety and ensures that the data is stored in the correct format.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'birthdate' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'looking_for_type' => 'array',
        'looking_for_gender' => 'array',
        'last_active_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable. Prevents mass-assignment vulnerabilities (where someone injects unexpected fields)
     *
     * @var array<int, string>
     */
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
        'last_active_at',
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
