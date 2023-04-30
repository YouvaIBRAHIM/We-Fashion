
<div>
    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto">
        <div class="p-4 bg-white shadow sm:rounded-lg">
            <div>    
                <form method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method(isset($product) ? 'PUT' : 'POST')
                    
                    <div class="form-row row">
                        <div class="form-group col-12 col-md-6 mb-4">
                            <label class="mt-2" for="productName">Nom du produit</label>
                            <input type="text" class="form-control mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow" id="productName" name="name" placeholder="Nom du produit" value="{{ isset($product) ? $product->name : old('name') }}" required>

                            <label class="mt-2" for="productDescription">Description</label>
                            <textarea class="form-control mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow" name="description" id="productDescription" rows="8" placeholder="Description" required>{{ isset($product) ? $product->description : old('description') }}</textarea>

                            <div class="form-group d-flex justify-content-around">
                                <div class="form-group d-flex flex-column align-items-center">
                                    <label class="mt-2" for="state">En solde</label>
                                    <input class="mb-2" id="state" name="state" type="checkbox" {{ isset($product) && $product->state == 'en solde' ? 'checked' : '' }} data-toggle="toggle" data-onlabel="Oui" data-offlabel="Non" data-onstyle="primary" data-offstyle="danger" data-onvalue="en solde" data-offvalue="standard">
                                </div>
                    
                                <div class="form-group d-flex flex-column align-items-center">
                                    <label class="mt-2" for="visibility">Publier</label>
                                    <input class="mb-2" id="visibility" name="isVisible" type="checkbox" {{ isset($product) && $product->is_visible == true ? 'checked' : '' }} data-toggle="toggle" data-onlabel="Oui" data-offlabel="Non" data-onvalue="true" data-offvalue="false" data-onstyle="primary" data-offstyle="danger">
                                </div>
                            </div>
                        </div>
                        @if(isset($product))
                            <div class="form-group col-12 col-md-6 mb-4">
                                <div class="box">
                                    <img src="{{ url('storage', $product->image) }}" alt="{{ $product->product_ref }}">
                                </div>
                            </div>
                        @endif
                        <div class="form-group col-12 col-md-6 mb-4">
                            <label class="mt-2" for="price">Prix</label>
                            <input type="decimal" class="form-control mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow" id="price" name="price" placeholder="Prix" value="{{ isset($product) ? $product->price : old('price') }}" required>
                            
                            <label class="mt-2" for="categories">Catégories</label>
                            <select class="form-control mb-2" id="categories" name="categories[]" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($product) && in_array($category->id, $productCategories) ? "selected" : (in_array($category->id, (Array)old('categories')) ? "selected" : "") }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <label class="mt-2" for="sizes">Tailles disponibles</label>
                            <select class="form-control mb-2" id="sizes" name="sizes[]" multiple>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ isset($product) && in_array($size->id, $productSizes) ? "selected" : (in_array($size->id, (Array)old('sizes')) ? "selected" : "") }}>{{ $size->size }}</option>
                                @endforeach
                            </select>

                            <label class="mt-2" for="image" class="form-label">Image</label>
                            <input class="form-control form-control-lg mb-2" id="image" type="file" name="image" {{ !isset($product) ? "required" : "" }}>
                        </div>

                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-4 float-right">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
        const multipleSelects = Array.from(document.querySelectorAll('select[multiple]'))
        multipleSelects.forEach(select => {
            new TomSelect(`#${select.id}`,{plugins:{remove_button:{title: 'Retirer'}}})
        });
    </script>