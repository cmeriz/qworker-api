<?php

namespace App\Http\Controllers\Api\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\User;
use App\Models\WishlistItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function wishlist(int $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $wishlist = $user->wishlist_items;

            if ($wishlist->count() === 0) {
                throw new Exception('La lista de deseos está vacía');
            }

            return ApiResponse::success('Lista de deseos', $wishlist);
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }
}
