<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        try {
            $data = $request->validated();
            $this->productRepository->create($data);

            return response()->json([
                'message' => 'Product has been created',
                'data' =>  $data,
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    
    /**
     * paginate
     *
     * @return JsonResponse
     */
    public function paginate(): JsonResponse
    {
        try {
            $products = $this->productRepository->read();

            return response()->json([
                'message' => 'Product has been returned',
                'data' =>  $products,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * update
     *
     * @param  ProductUpdateRequest $request
     * @param  Product $product
     * @return void
     */
    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        try {
            $data = $request->validated();
            $this->productRepository->update($data, $product);
            return response()->json([
                'message' => 'Product has been updated successfully',
                'data' => $data,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    
    /**
     * destroy
     *
     * @param  Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $this->productRepository->delete($product);
            return response()->json([
                'message' => 'Product has been deleted successfully',
            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
