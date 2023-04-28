<style>
    .box{
        width: 100%;
        height: 100%;
        max-height: 450px;
        position: relative;
    }

    
</style>
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
                <form method="POST" action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method(isset($category) ? 'PUT' : 'POST')
                    
                    <div class="form-row row">
                        <div class="form-group col-6">
                            <label class="mt-2" for="categoryName">Nom de la catégorie</label>
                            <input type="text" class="form-control mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded shadow" id="productName" name="name" placeholder="Nom de la catégorie" value="{{ isset($category) ? $category->name : old('name') }}" required>

                        </div>
                        @if(isset($category))
                            <div class="form-group col-6">
                                <div class="box">
                                    {{ $category->slug }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-4 float-right">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
