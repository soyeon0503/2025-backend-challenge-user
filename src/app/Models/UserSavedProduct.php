<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class UserSavedProduct extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
