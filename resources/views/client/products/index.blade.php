<x-guest-layout>
    <div class="productsFound">
        <span>
            {{$productsList->total()}} résultats
        </span>
        @if(isset($categoryName))
            <h3>
                {{ $categoryName }}
            </h3>
        @endif
    </div>
    <div class="cards-container">
        @if($productsList->total() > 0)
            @foreach($productsList as $product)
                @include('client.products.productCard', [ 'product' => $product])
            @endforeach
        @else
            <div class="noProductsFound">
                <h2>
                    Oups ! On n'a trouvé aucun produit 
                </h2>
            </div>
        @endif
    </div>

    {{ $productsList->links() }}

</x-guest-layout>
