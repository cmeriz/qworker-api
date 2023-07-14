<?php

namespace App\Http\Controllers\Api\v1\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            return ApiResponse::success(
                'Usuario autenticado',
                $user
            );
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }

    public function wishlist()
    {
        try {
            $logged_user = Auth()->user();
            $wishlist = $logged_user->wishlist_items;

            if (empty($wishlist)) throw new Exception('Tu lista de deseos está vacía');

            return ApiResponse::success(
                'Tu lista de deseos',
                $wishlist
            );
        } catch (\Exception $e) {
            return ApiResponse::handleException($e);
        }
    }

    public function partners()
    {
        try {
            $user = Auth()->user();
            $partners = User::query()
                ->where('department_id', $user->department_id)
                ->whereNot('id', $user->id)
                ->get();
            return ApiResponse::success('Tus colegas', $partners);
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }
}
