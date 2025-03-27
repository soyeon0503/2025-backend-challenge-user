<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLikeProduct;
use App\Models\Product;

class UserLikeProductController extends Controller
{
    /**
     * 로그인한 유저가 좋아요한 상품 목록 조회
     */
    public function index()
    {
        $user = Auth::user();
        $likedProducts = $user->likedProducts()->with('company')->get();
        
        return view('likes.index', compact('likedProducts'));
    }

    /**
     * 좋아요 토글 (저장 & 취소)
     */
    public function toggle(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['error' => '로그인이 필요합니다.'], 401);
        }

        $user = Auth::user();
        $like = UserLikeProduct::where('user_id', $user->id)
                               ->where('product_id', $product->id)
                               ->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false, 'message' => '좋아요를 취소했습니다.']);
        }

        UserLikeProduct::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return response()->json(['liked' => true, 'message' => '좋아요를 추가했습니다.']);
    }
}
