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
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsList = Product::orderBy("created_at", "desc")->paginate(6);
        return view('backend.products.index', ['productsList' => $productsList]);
    }

    public function clientIndex()
    {
        $productsList = Product::where("is_visible", 1)->with(["categories", "sizes"])->orderBy("created_at", "desc")->paginate(6);
        return view('client.products.index', ['productsList' => $productsList]);
    }

    
    public function clientPromotionsIndex()
    {
        $categoryName = "Soldes";
        $productsList = Product::where([["is_visible", 1], ["state", "en solde"]])->with(["categories", "sizes"])->orderBy("created_at", "desc")->paginate(6);
        return view('client.products.index', ['productsList' => $productsList, 'categoryName' => $categoryName]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('backend.products.create', ["categories" => $categories, "sizes" => $sizes]);
    }

    /**
     * Store a newly created resource in storage.
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
            'product_ref' => "tmp_ref"
        ]);

        $newProductId = $newProduct->id;
        $newProductRef = 'ART' . str_pad($newProductId, 6, '0', STR_PAD_LEFT);

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
    * Display the specified resource.
    */
    public function show(Product $product, $id)
    {
        $product = Product::where([ ["id", $id]])->with(["categories", "sizes"])->firstorfail();

        $otherProducts = Product::where([["is_visible", 1], ["id", "<>", $id]])->with(["categories", "sizes"])->inRandomOrder()->take(10)->get();
        return view('client.products.product', ['product' => $product, 'otherProducts' => $otherProducts ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productCategories = $product->categories()->pluck('categories.id')->toArray();
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
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $productRef = $product->product_ref;
        $productId = $product->id;

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
            
            // supprime l'ancienne image
            $this->deletePreviousImage($previousImage);

            $storageFolder = "products_images/$productRef";
            $path = Storage::disk('public')->putFile($storageFolder, $selectedImage);
            $product->update([
                "image" => $path
            ]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productRef = $product->product_ref;
        $this->deletePreviousImage($product->image);
        $product->delete();
        return redirect(route("product.index"))->with('success', "Le produit $productRef a bien été supprimé.");
    }

    public function deletePreviousImage(String $productImage)
    {
        if (Storage::exists("public/$productImage")) {
            Storage::delete("public/$productImage");
        }
    }

    public function multipleDelete(Request $request)
    {
        $productsToDelete = explode(",", $request->productIds);
        $products = Product::whereIn('id', $productsToDelete)->get();
        foreach ($products as $product) {
            $this->deletePreviousImage($product->image);
            $product->delete();
        }
        return redirect(route("product.index"))->with('success', "Les produits sélectionnés ont bien été supprimés.");
    }
}
