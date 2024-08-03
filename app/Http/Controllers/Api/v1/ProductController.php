<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private $productRepository;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {

        $data = $request->validated();
        $this->productRepository->create($data);

        return response()->json([
            'message' => 'Product has been created',
            'data' =>  $data,
        ], 200);
    }

    /**
     * paginate
     *
     * @return void
     */
    public function paginate(): JsonResponse
    {
        $products = $this->productRepository->read();

        return response()->json([
            'message' => 'Product has been created',
            'data' =>  $products,
        ], 200);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        $data = $request->validated();
        $this->productRepository->update($data, $product);
        return response()->json([
            'message' => 'Product has been updated successfully',
            'data' => $data,
        ], 200);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->productRepository->delete($product);
        return response()->json([
            'message' => 'Product has been deleted successfully',
        ], 204);
    }
}
