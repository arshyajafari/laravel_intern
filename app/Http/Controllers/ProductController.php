<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store (Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'max:20']
        ]);

        return response()->json(
            Product::create($data)
        );
    }

    /**
     * @return JsonResponse
     */
    public function get (): JsonResponse
    {
        return response()->json(
            Product::get()
        );
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function getById (string $id): JsonResponse
    {
        $product = Product::where('id', $id)->first();

        if (! empty($product))
        {
            return response()->json(
                $product
            );
        }

        return response()->json(
            [
                'code' => '1',
                'message' => 'product not found'
            ],
            404
        );
    }

    public function updateById (string $id, Request $request)
    {
        $data = $request->validate([
            'title' => ['string', 'max:150'],
            'description' => [ 'string', 'max:1000'],
            'price' => [ 'numeric', 'max:20']
        ]);

        Product::where('id', $id)->update($data);

        return response()->json([
            'message' => 'product updated successfully'
        ]);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function deleteById(string $id): JsonResponse
    {
        Product::where('id', $id)->delete();

        return response()->json([
            'message' => 'product deleted successfully'
        ]);
    }
}
