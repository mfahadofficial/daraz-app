<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;

class ProductService extends BaseService
{

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function allProduct()
    {

        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        return $this->repository->allProduct();
    }

    public function addProduct(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'detail' => 'required',
            'user_id' => 'required',
          
        ]);
        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);




        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0]
            ]);

        $product = $this->create($request->except('_token'));

        if (!is_null($product))
            return response()->json([
                'status' => 'success',
                'id' => $product->id,
            ]);
        else
            return response()->json([
                'status' => 'error',
                'message' => 'System error'
            ]);
    }

    public function remove(int $id)
    {
        if ($this->repository->remove($id))
            return response()->json([
                'status' => 'success'
            ]);
        else
            return response()->json([
                'status' => 'error'
            ]);
    }

    public function updateProduct(Request $request, $id)
    {

        
        $product = $this->repository->find($id);
        // return($product);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'user_id' => 'required',
          
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0]
            ]);

        $this->repository->update($product->id, $request->except(['_token', 'id', 'dates']));
        // $this->repository->createDate($product->id, $request->input('dates'));

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function getList($tern = NULL)
    {
        $array = [
            'results' => []
        ];

        $products = is_null($tern) ? $this->all() : $this->repository->search($tern);

        foreach ($products as $item) {
            $array['results'][] = [
                'text' => $item->id . " | " . $item->title,
                'id' => $item->id,
            ];
        }

        return response()->json($products);
    }


}
