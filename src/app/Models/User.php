<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserLikeProduct;
use App\Models\UserSavedProduct;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'user_like_products', 'user_id', 'product_id')->withTimestamps();
    }
    
    public function savedProducts()
    {
        return $this->belongsToMany(Product::class, 'user_saved_products', 'user_id', 'product_id')->withTimestamps();
    }
    
}
