<?php

namespace App\Http\Controllers\Api\v1\WishlistItems;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\User;
use App\Models\WishlistItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistItemController extends Controller
{
    public function show(int $wishlist_item_id)
    {
        try {
            $wishlist_item = WishlistItem::findOrFail($wishlist_item_id);

            return ApiResponse::success(
                'Item de la lista de deseos',
                $wishlist_item
            );
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        try {
            $wishlist_item = WishlistItem::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth()->id(),
                'image_path' => '/600x400/png'
            ]);

            return ApiResponse::created(
                'Se agregó item a la lista de deseos',
                $wishlist_item
            );
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }

    public function update(Request $request, int $wishlist_item_id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        try {
            $wishlist_item = WishlistItem::findOrFail($wishlist_item_id);

            $wishlist_item->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return ApiResponse::success('El item ha sido actualizado', $wishlist_item);
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }

    public function destroy(int $wishlist_item_id)
    {
        try {
            WishlistItem::where('id', $wishlist_item_id)->delete();
            return ApiResponse::success('El item ha sido eliminado');
        } catch (Exception $e) {
            return ApiResponse::handleException($e);
        }
    }
}
