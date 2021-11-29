<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Services\ProductService;
use App\Models\Product;
use Validator;

// use App\Http\Resources\Product as resProduct ;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

      public function index()
    {
        return $this->productService->allProduct();
        //  return response()->json(Auth::user()->role_id);
    }

    public function store(Request $request)
    {
        return $this->productService->addProduct($request);  
    } 
   
    public function show($id)
    {
        // $test = $this->productService->find($id);   
        // return ($test->category);
        return $this->productService->find($id);   
    }
    
    public function update(Request $request, $id)
    {

        // return($request);
        
        return $this->productService->updateCategory($request, $id);
        
    }
    public function update2(Request $request, $id)
    {

        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);

       
        
        return $this->productService->updateProduct($request, $id);
        
    }

    public function destroy($id)
    {
        return $this->productService->remove($id);
    }

    public function get_list(Request $request)
    {
        return $this->productService->getList($request->category_id);
    }

    public function admin()
    {

        return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        // $product->delete();
   
        // return $this->sendResponse([], 'Product deleted successfully.');
    }

    public function vendorProducts(){
        // return ('test');

        return $this->productService->vendorProducts();
    }
}