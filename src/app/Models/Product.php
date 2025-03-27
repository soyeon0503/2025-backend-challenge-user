<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manager;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

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

     /**
     * 이 상품을 좋아요한 유저 목록 (Many-to-Many 관계)
     */
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'user_like_products', 'product_id', 'user_id');
    }

    /**
     * 이 상품을 저장한 유저 목록 (Many-to-Many 관계)
     */
    public function savedUsers()
    {
        return $this->belongsToMany(User::class, 'user_saved_products', 'product_id', 'user_id');
    }

    /**
     * 현재 로그인한 유저가 이 상품을 좋아요했는지 여부 확인
     */
    public function likedByUser()
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->likedUsers()->where('user_id', Auth::id())->exists();
    }

    /**
     * 현재 로그인한 유저가 이 상품을 저장했는지 여부 확인
     */
    public function savedByUser()
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->savedUsers()->where('user_id', Auth::id())->exists();
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'product_id');
    }

}
