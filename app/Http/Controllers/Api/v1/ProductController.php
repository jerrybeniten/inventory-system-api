<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;
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
    public function store(ProductStoreRequest $request) {

        $data = $request->validated();
        $this->productRepository->create($data);

        return response()->json([
            'message' => 'Product has been created',
            'data' =>  $data,
        ], 200);
    }

    public function paginate() {        
        $products = $this->productRepository->read();

        return response()->json([
            'message' => 'Product has been created',
            'data' =>  $products,
        ], 200);
    }


}
