<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Manager;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    // create나 update 할 때 사용할 수 있는 필드
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function Manager()
    {
        return $this->hasMany(Manager::class);
    }

}
