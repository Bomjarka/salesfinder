<?php

namespace App\Http\Controllers\Api\V1\Tokens;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShopKeyRequest;
use App\Models\Shop;
use App\Models\ShopKeys;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * @param StoreShopKeyRequest $request
     * @return JsonResponse
     */
    public function storeOrUpdate(StoreShopKeyRequest $request): JsonResponse
    {
        $shopId = $request->get('shop_id');
        $shop = Shop::find($shopId);

        if (!$shop) {
            return response()->json('Shop: ' . $shopId . ' not found', 404);
        }

        $shopToken = ShopKeys::findOrNew($shopId);
        $shopToken->fill($request->all());
        $shopToken->save();

        return response()->json($shopToken);
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return response()->json(ShopKeys::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function restore(Request $request): JsonResponse
    {
        $tokenId = $request->get('token_id');
        $shopToken = ShopKeys::find($tokenId);

        if (!$shopToken) {
            return response()->json('Token: ' . $tokenId . ' not found', 404);
        }

        if ($shopToken->enabled === false) {
            return response()->json('Token: ' . $tokenId . ' not active');
        }
        $shopToken->restore();

        return response()->json('Shop token: ' . $shopToken->id . ' disabled');
    }
}
