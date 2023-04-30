<x-app-layout>
    <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Produits</a></li>
        <li class="breadcrumb-item active">Création</li>
    </ol>
    <h3 class="mt-4">Nouveau produit</h3>
    
    @include('backend.products.form')
</x-app-layout>