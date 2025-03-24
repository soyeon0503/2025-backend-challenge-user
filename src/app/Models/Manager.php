<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Company;

class Manager extends Model
{
     use HasFactory;

     protected $table = 'managers';
 
     protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'department',
        'company_id',
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
