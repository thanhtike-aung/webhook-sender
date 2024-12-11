<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(): View
    {
        $response = Http::withOptions(['verify' => false])
            ->timeout(10)
            ->get('https://fakestoreapi.com/products');
        if (!$response->successful()) {
            return response()->json(['error' => 'Unable to fetch products!'], $response->status());
        }
        return view('products', [
            'products' => $response->json(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function orderProduct(Request $request): RedirectResponse|JsonResponse
    {
        $endpoint = 'http://localhost:9090/webhook/zmt';
        $payload = $request->all();
        try {
            Http::post($endpoint, $payload);
            return redirect()->back()->with('toast', 'Your order has been successfully processed!');
        } catch (Exception $e) {
            info($e->getTraceAsString());
            return response()->json($e->getMessage());
        }
    }
}
