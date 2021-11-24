<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Validator;
use Image;
use Storage;

class CategoryService extends BaseService
{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function allCategory()
    {

        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        return $this->repository->allCategory();
    }

    public function addCategory(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'categoryType' => 'required',

          
        ]);
        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);




        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0]
            ]);

        $category = $this->create($request->except('_token'));

        if (!is_null($category))
            return response()->json([
                'status' => 'success',
                'id' => $category->id,
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

    public function updateCategory(Request $request, $id)
    {

        
        $category = $this->repository->find($id);
  

        $validator = Validator::make($request->all(), [
            'categoryType' => 'required',
          
          
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()[0]
            ]);

        $this->repository->update($category->id, $request->except(['_token', 'id', 'dates']));
        // $this->repository->createDate($product->id, $request->input('dates'));

        return response()->json([
            'status' => 'success'
        ]);
    }





}