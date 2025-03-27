<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSavedProduct;
use App\Models\Product;

class UserSavedProductController extends Controller
{
    /**
     * 로그인한 유저가 저장한 상품 목록 조회
     */
    public function index()
    {
        $user = Auth::user();
        $savedProducts = $user->savedProducts()->with('company')->get();
        
        return view('saves.index', compact('savedProducts'));
    }

    /**
     * 저장 토글 (저장 & 취소)
     */
    public function toggle(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['error' => '로그인이 필요합니다.'], 401);
        }

        $user = Auth::user();
        $save = UserSavedProduct::where('user_id', $user->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($save) {
            $save->delete();
            return response()->json(['saved' => false, 'message' => '저장을 취소했습니다.']);
        }

        UserSavedProduct::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return response()->json(['saved' => true, 'message' => '상품을 저장했습니다.']);
    }
}
