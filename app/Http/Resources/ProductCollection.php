<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public static $wrap = 'products';

    public function toArray($request)
    {
        return $this->map(function ($data) {
            return [
                'sku' => $data->sku,
                'name' => $data->name,
                'category' => $data->category,
                'price' => $this->getPriceMeta($data->id),
            ];
        });
    }

    protected function getPriceMeta($id)
    {
        $product = resolve(\App\Services\ProductService::class)->getProductById($id);
        return [
            'original' => $product->price,
            'final' => $product->discount ? round(
                $product->price * (1 - ($product->discount / 100)),
                -1
            ) : $product->price,
            'discount_percentage' => $product->discount,
            'currency' => $product->currency,
        ];
    }
}
