<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
    * Affiche la view des produits coté administration
    */
    public function index()
    {
        $productsList = Product::orderBy("created_at", "desc")->paginate(15);
        return view('backend.products.index', ['productsList' => $productsList, 'isTrashView' => false]);
    }

    /**
    * Affiche la view des produits dans la corbeille coté administration
    */
    public function productsTrash()
    {
        $productsList = Product::onlyTrashed()->orderBy("created_at", "desc")->paginate(15);
        return view('backend.products.index', ['productsList' => $productsList, 'isTrashView' => true]);
    }

    /**
    * Affiche la view des produits coté client
    */
    public function clientIndex()
    {
        $productsList = Product::where("is_visible", 1)->with(["categories", "sizes"])->orderBy("created_at", "desc")->paginate(6);
        return view('client.products.index', ['productsList' => $productsList]);
    }

    /**
    * Affiche la view des produits en solde coté client
    */
    public function clientPromotionsIndex()
    {
        $categoryName = "Soldes";
        $productsList = Product::where([["is_visible", 1], ["state", "en solde"]])->with(["categories", "sizes"])->orderBy("created_at", "desc")->paginate(6);
        return view('client.products.index', ['productsList' => $productsList, 'categoryName' => $categoryName]);
    }

    /**
    * Affiche la view d'un formulaire de création d'un produit coté administration
    */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('backend.products.create', ["categories" => $categories, "sizes" => $sizes]);
    }

    /**
     * Enregistre un nouveau produit
     *
     * App\Http\Requests\ProductRequest Class de validation du formulaire d'ajout d'un produit
     */
    public function store(ProductRequest $request)
    {
        $selectCategories = $request->categories;
        $selectSizes = $request->sizes;

        
        $newProduct = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'is_visible' => filter_var($request->isVisible, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'state' => $request->state,
            'product_ref' => uniqid()
        ]);

        $newProductId = $newProduct->id;
        $newProductRef = 'REF' . str_pad($newProductId, 13, '0', STR_PAD_LEFT);

        $storageFolder = "products_images/$newProductRef";

        $selectedImage = $request->file('image');
        $path = Storage::disk('public')->putFile($storageFolder, $selectedImage);

        $newProduct->update([
            "image" => $path,
            'product_ref' => $newProductRef
        ]);

        $newProduct->categories()->attach($selectCategories);
        if (count($selectSizes) > 0) {
            $newProduct->sizes()->attach($selectSizes);
        }

        return redirect(route('product.index'))->with('success', "Le produit $newProductRef a bien été ajouté.");
    }

    /**
    * Affiche la view d'un produit coté client
    */
    public function show(Product $product, $id)
    {

        $product = Product::where([ ["id", $id]])->with(["categories", "sizes"])->firstorfail();

        $otherProducts = Product::where([["is_visible", 1], ["id", "<>", $id]])->with(["categories", "sizes"])->inRandomOrder()->take(10)->get();
        return view('client.products.product', ['product' => $product, 'otherProducts' => $otherProducts ]);
    }

    /**
     * Affiche la view d'un formulaire d'edition d'un produit coté administration
     */
    public function edit(Product $product)
    {
        // récupération des id des categories du produit à editer
        $productCategories = $product->categories()->pluck('categories.id')->toArray();

        // récupération des id des tailles du produit à editer
        $productSizes = $product->sizes()->pluck('sizes.id')->toArray();

        $categories = Category::all();
        $sizes = Size::all();
        
        return view('backend.products.update', [
            "product" => $product, 
            "productCategories" => $productCategories, 
            "productSizes" => $productSizes, 
            "categories" => $categories, 
            "sizes" => $sizes
        ]);
    }

    /**
     * Mise à jour d'un produit
     * App\Http\Requests\ProductRequest Class de validation du formulaire de modification du produit
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productRef = $product->product_ref;

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_visible' => filter_var($request->isVisible, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'state' => $request->state
        ]);

        //stockage et mise à jour de l'image du produit si une nouvelle image a été selectionnée
        if ($selectedImage = $request->file('image')) {
            $previousImage = $product->image;

            $storageFolder = "products_images/$productRef";
            $path = Storage::disk('public')->putFile($storageFolder, $selectedImage);
            $product->updateOrFail([
                "image" => $path
            ]);
            // supprime l'ancienne image
            $this->deleteImage($previousImage);
        }

        //Mise à jour des categories du produit
        $selectCategories = $request->categories;
        $previousCategories = $product->categories()->pluck('categories.id')->toArray();

        //categories à ajouter au produit
        $newCategories = array_diff((array)$selectCategories, (array)$previousCategories);
        $product->categories()->sync($newCategories, false);

        //categories à supprimer au produit
        $categoriesToDelete = array_diff((array)$previousCategories, (array)$selectCategories);
        $product->categories()->detach($categoriesToDelete);

        //Mise à jour des tailles du produit
        $selectSizes = $request->sizes;
        $previousSizes = $product->sizes()->pluck('sizes.id')->toArray();

        //tailes à ajouter au produit
        $newSizes = array_diff((array)$selectSizes, (array)$previousSizes);
        $product->Sizes()->sync($newSizes, false);

        //tailles à supprimer au produit
        $sizesToDelete = array_diff((array)$previousSizes, (array)$selectSizes);
        $product->sizes()->detach($sizesToDelete);
        
        return redirect(route('product.index'))->with('success', "Le produit $productRef a bien été mis à jour.");

    }

    /**
     * Met un produit dans la corbeille
     */
    public function destroy(Product $product)
    {
        $productRef = $product->product_ref;
        $product->delete();
        return redirect(route("product.index"))->with('success', "Le produit $productRef a été mis dans la corbeille.");
    }
    
    /**
     * Supprime définitivement un produit depuis la corbeille
    */
    public function definitiveDestroy(Product $product, $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $productRef = $product->product_ref;
        $this->deleteImage($product->image);
        $product->forceDelete();
        return redirect(route("product.trash"))->with('success', "Le produit $productRef a été supprimé.");
    }

    /**
     * Met plusieurs produits dans la corbeille
    */
    public function multipleDelete(Request $request)
    {
        $productsToDelete = explode(",", $request->productIds);
        Product::whereIn('id', $productsToDelete)->delete();
        return redirect(route("product.index"))->with('success', "Les produits sélectionnés ont bien été mis dans la corbeille.");
    }

    /**
     * Supprime définitivement plusieurs produits
    */
    public function multipleDefinitiveDelete(Request $request)
    {

        $productsToDelete = explode(",", $request->productIds);
        $products = Product::onlyTrashed()->whereIn('id', $productsToDelete)->get();
        foreach ($products as $product) {
            $this->deleteImage($product->image);
            $product->forceDelete();
        }
        return redirect(route("product.trash"))->with('success', "Les produits sélectionnés ont bien été supprimés.");
    }

    
    /**
     * Restaure un produit de la corbeille
    */
    public function restore(Product $product, $id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $productRef = $product->product_ref;
        $product->restore();
        return redirect(route("product.trash"))->with('success', "Le produit $productRef a été restauré.");
    }

    /**
     * Restaure plusieurs produits de la corbeille
    */
    public function multipleRestore(Request $request)
    {
        Product::onlyTrashed()->whereIn('id', $request->productIds)->restore();
        return redirect(route("product.trash"))->with('success', "Les produits sélectionnés ont bien été restaurés.");
    }

    /**
     * Supprime du serveur l'image d'un produit
    */
    public function deleteImage(String $productImage)
    {
        // vérifie si l'image existe dans le repertoire et si ce n'est pas une image provenant des dossiers Hommes et Femmes
        //Dans le cadre des tests, d'autres produits se partagent les memes images. Par conséquent, certains produits n'auront plus d'image
        if (Storage::exists("public/$productImage") && !preg_match("#\b(hommes|femmes)\b#",$productImage)) {
            Storage::delete("public/$productImage");
        }
    }
    
}
