<x-app-layout>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Fiche</li>
    </ol>
    <h3 class="mt-4">Fiche produit</h3>
    
    @include('products.form')
</x-app-layout>