<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsList = Product::orderBy("created_at", "desc")->paginate(15);

        return view('products.index', ['productsList' => $productsList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('products.create', ["categories" => $categories, "sizes" => $sizes]);
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
            'is_visible' => $request->isVisible == 'on' ? true : false,
            'state' => $request->state == 'on' ? 'en solde' : 'standard',
            'product_ref' => "tmp_ref"
        ]);

        $newProductId = $newProduct->id;
        $newProductRef = 'ART' . str_pad($newProductId, 6, '0', STR_PAD_LEFT);

        $storageFolder = "/public/products_images/$newProductRef";

        $selectedImage = $request->file('image');
        $path = Storage::disk('local')->putFile($storageFolder, $selectedImage);

        $newProduct->update([
            "image" => $path,
            'product_ref' => $newProductRef
        ]);
        // echo '<pre>';
        // var_dump($newProduct);
        // echo '</pre>';
        // die();

        // $categories = Category::whereIn('id', $selectCategories)->get();

        $newProduct->categories()->attach($selectCategories);
        if (count($selectSizes) > 0) {
            // $sizes = Size::whereIn('id', $selectSizes)->get();
            $newProduct->sizes()->attach($selectSizes);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
