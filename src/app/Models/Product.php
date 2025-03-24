<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manager;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'company_id',
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
