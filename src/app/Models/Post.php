<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 테이블 이름 설정 (기본값은 "posts")
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'status',
        'company_id',
        'manager_id',
        'product_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
