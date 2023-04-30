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
     * Affiche la liste de categories
     */
    public function index()
    {
        // la methode withCount récupète le nombre de produits par catégorie et la stocke dans la clé products_count
        $categoriesList = Category::withCount('products')->orderBy("created_at", "desc")->paginate(15);

        return view('backend.categories.index', ['categoriesList' => $categoriesList]);
    }

    /**
     * Affiche le formulaire de création d'une nouvelle categorie
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Ajoute une nouvelle catégorie
     *
     * App\Http\Requests\CategoryRequest Class de validation du formulaire d'ajout d'une catégorie
     */
    public function store(CategoryRequest $request)
    {
        // vérifie si la catégorie existe déjà. Si ce n'est pas le cas, ça créé une nouvelle catégorie
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
     * Récupère les produits d'une catégorie selon le slug pour les afficher coté client
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
     * Affiche le formulaire d'edition d'une catégorie coté administration
     */
    public function edit(Category $category)
    {
        return view('backend.categories.update', [
            "category" => $category
        ]);
    }

    /**
     * Met à jour une catégorie
     *
     * App\Http\Requests\CategoryRequest Class de validation du formulaire de modification d'une catégorie
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
     * Supprime un catégorie de la base de données
     */
    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();
        return redirect(route("category.index"))->with('success', "La catégorie <strong>$categoryName</strong> a bien été supprimée.");
    }

    /**
     * Supprime plusieurs catégories de la base de données
     */
    public function multipleDelete(Request $request)
    {
        $categoriesToDelete = explode(",", $request->categoryIds);
        Category::whereIn('id', $categoriesToDelete)->delete();
        return redirect(route("category.index"))->with('success', "Les catégories sélectionnées ont bien été supprimées.");
    }
}
