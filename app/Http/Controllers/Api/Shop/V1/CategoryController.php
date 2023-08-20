<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\ApiCreateCategoryRequest;
use App\Http\Requests\Api\Category\ApiUpdateCategoryRequest;
use App\Http\Resources\V1\Category\CategoryCollection;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\CategoryRepository;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $categoryRepo;
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->categoryRepo->setRelations(['type:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->categoryRepo->setFilters($request->all());
        $categories = $this->categoryRepo->all();
        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiCreateCategoryRequest $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $request->merge(['slug' => $slug]);
        $category = auth()->user()->created_categories()->create($request->all());
        return new CategoryResource($category->load(['main_category']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, ApiUpdateCategoryRequest $request)
    {
        $category = $this->categoryRepo->update($category, $request->all());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
