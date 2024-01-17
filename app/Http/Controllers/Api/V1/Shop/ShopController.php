<?php

namespace App\Http\Controllers\Api\V1\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetStocksRequest;
use App\Http\Requests\Api\StoreShopRequest;
use App\Models\Shop;
use App\Models\User;
use App\Services\StatisticsService;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $user_id = $request->get('user_id');
        $user = User::find($user_id);

        if (!$user) {
            return response()->json('User: ' . $user_id . ' not found', 404);
        }

        return response()->json($user->shops);
    }

    /**
     * @param StoreShopRequest $request
     * @return JsonResponse
     */
    public function store(StoreShopRequest $request): JsonResponse
    {
        $userId = $request->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json('User: ' . $userId . ' not found', 404);
        }

        $shop = Shop::create([
            'user_id' => $user->id,
            'name' => $request->get('shop_name'),
        ]);

        return response()->json($shop);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function restore(Request $request): JsonResponse
    {
        $shopId = $request->get('shop_id');
        $shop = Shop::find($shopId);

        if (!$shop) {
            return response()->json('Shop: ' . $shopId . ' not found', 404);
        }

        $shop->getActiveToken()->restore();
        $shop->restore();

        return response()->json('Shop: ' . $shop->name . ' and its token disabled');
    }

    public function getStocks(GetStocksRequest $request, StatisticsService $service)
    {
        $shopId = $request->get('shop_id');
        $shop = Shop::find($shopId);

        if (!$shop) {
            return response()->json('Shop: ' . $shopId . ' not found', 404);
        }

        $from = CarbonImmutable::parse($request->get('from'));

        $service->getStocks($shop, $from);
    }
}
