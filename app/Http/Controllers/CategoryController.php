<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesList = Category::withCount('products')->orderBy("created_at", "desc")->paginate(15);

        return view('backend.categories.index', ['categoriesList' => $categoriesList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        
        $category = Category::firstOrCreate([
            'name' => ucfirst($request->name),
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($category->wasRecentlyCreated) {
            return redirect(route("category.index"))->with('success', "La catégorie <strong>$request->name</strong> a bien été ajoutée.");
        }else {
            return redirect(route("category.index"))->with('warning', "La catégorie <strong>$request->name</strong> existe déjà.");

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, $slug)
    {
        $category = Category::where("slug", $slug)->firstorfail();
        
        $categoryName = $category->name;

        $productsList = $category->products()
                                    ->where("is_visible", 1)
                                    ->with(["categories", "sizes"])
                                    ->orderBy("created_at", "desc")
                                    ->paginate(6);

        return view('client.products.index', ['productsList' => $productsList, 'categoryName' => $categoryName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.categories.update', [
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $previousCategoryName = $category->name;
        $categoryId = $category->id;

        if ($previousCategoryName !== $request->name) {
            $category->update([
                'name' => ucfirst($request->name),
                'slug' => Str::slug($request->name, '-')
            ]);
    
            return redirect(route("category.edit", $categoryId))->with('success', "Le nom de la catégorie <strong>$previousCategoryName</strong> a été modifié en <strong>$request->name</strong>.");
        }

        return redirect(route("category.edit", $categoryId))->with('warning', "Vous n'avez fait aucune modification");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();
        return redirect(route("category.index"))->with('success', "La catégorie <strong>$categoryName</strong> a bien été supprimée.");
    }

    public function multipleDelete(Request $request)
    {
        $categoriesToDelete = explode(",", $request->categoryIds);
        Category::whereIn('id', $categoriesToDelete)->delete();
        return redirect(route("category.index"))->with('success', "Les catégories sélectionnées ont bien été supprimées.");
    }
}
