<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Mass assignment 허용할 필드
    protected $fillable = ['title', 'content', 'writer'];

    // 테이블 이름 설정 (기본값은 "posts")
    protected $table = 'posts';

}
