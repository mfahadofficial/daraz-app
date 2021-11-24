<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->categoryService->allCategory();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->categoryService->addCategory($request);  
    } 


    public function show($id)
    {
        return $this->categoryService->find($id);   
    }





    public function update(Request $request, $id)
    {
         return $this->categoryService->updateCategory($request, $id);
    }


    public function destroy( $id)
    {
        return $this->categoryService->remove($id);
    }
}
