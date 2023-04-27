<x-app-layout>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <h3 class="mt-4">Produits</h3>

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-end my-2">
        <a href="{{ route('product.create') }}" class="btn btn-primary">Ajouter un produit</a>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Réf</th>
            <th scope="col">Nom</th>
            <th scope="col">État</th>
            <th scope="col">Visibilité</th>
            <th scope="col"  class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsList as $product)
                <tr>
                    <th scope="row">{{$product->product_ref}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{strtoupper($product->state)}}</td>
                    <td>
                        <span class="{{$product->is_visible ? 'text-success' : 'text-danger'}}">{{$product->is_visible ? "Publié" : "Non publié"}}</span>
                    </td>

                    <td>
                        <div class="d-flex justify-content-around">
                            <a href="{{ route('product.edit', $product->id) }}" class="edit" title="Éditer" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                            <button id="deleteButton" type="button" data-toggle="modal" data-target="#deleteModal"  data-product-id="{{ $product->id }}" data-product-ref="{{ $product->product_ref }}">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endForeach

        </tbody>

    </table>
    {{ $productsList->links() }}
    
    @include('products.deleteModal')

</x-app-layout>