@section('title', 'Édition du produit ' . $product->product_ref . ' - WeFashion')

<x-app-layout>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Fiche</li>
    </ol>
    <h3 class="mt-4">Fiche produit {{ $product->product_ref }}</h3>
    
    @include('backend.products.form')
</x-app-layout>