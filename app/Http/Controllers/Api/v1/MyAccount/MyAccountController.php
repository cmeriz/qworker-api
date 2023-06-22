<?php

namespace App\Http\Controllers\Api\v1\MyAccount;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
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
}
