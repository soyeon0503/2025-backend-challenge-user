<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Models\Product;
use App\Models\Company;

class Manager extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

     protected $table = 'managers';
 
     protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'department',
        'company_id',
        'role', // 0: 최고 관리자, 1: 일반 관리자
     ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
