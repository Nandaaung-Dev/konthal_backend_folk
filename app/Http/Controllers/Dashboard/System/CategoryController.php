<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CreateCategoryRequest;
use App\Http\Requests\Dashboard\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Type;
use App\Repositories\Api\System\V1\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public $cateRepo;
    public function __construct(CategoryRepository $cateRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:categories-create', ['only' => 'create', 'store']);
        $this->middleware('permission:categories-edit', ['only' => 'edit', 'update']);
        $this->cateRepo = $cateRepo;
        $this->cateRepo->setRelations('type');

        $this->cateRepo->setPagination(5);
    }

    public function index()
    {

        $categories = $this->cateRepo->paginate();
        return Inertia::render('Categories/Index', [

            'can' => [
                'create' => auth()->user()->can('categories-create'),
                'edit' => auth()->user()->can('categories-edit'),
                'delete' => auth()->user()->can('categories-delete')
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin')
            ],
            'resource_name' => 'categories',
            'deletable' => false,
            'categories' => $categories

        ]);
    }
    public function create()
    {

        $types=Type::all();
        return Inertia::render('Categories/CreateCategoryForm',['types'=>$types]);
        
    }
    public function store(CreateCategoryRequest $request)
    {  
        $request['slug']=Str::of($request->name)->slug('-');
       $this->cateRepo->create($request->all());
        return redirect()->route('system_dashboard.categories.index')->with('message', 'Category was created!');
    }
    public function edit(Category $category)
    {

        $types=Type::all();
        return Inertia::render('Categories/EditCategoryForm',['types'=>$types,'category'=>$category]);
    
    }
    public function update(Category $category, UpdateCategoryRequest $request)
    {
       $this->cateRepo->update($category,$request->all());
        return redirect()->route('system_dashboard.categories.index')->with('message', 'Category was updated.');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('system_dashboard.categories.index')->with('message', 'Category was deleted.');
    }
}
