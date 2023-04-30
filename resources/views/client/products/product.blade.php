@section('title', 'WeFashion - ' . $product->name)

<x-guest-layout>
    <div class="productContainer">

        <div class="product-image">
            @if($product->state == "en solde")
                <span class="banner"></span>
            @endif
            <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}" class="product-pic">
        </div>
        <div class="product-details">

            <h1 class="title">{{ $product->name }}</h1>
            <div class="price">
                <span class="current">{{ $product->price }}€</span>
            </div>
            <span class="colorCat">{{ $product->product_ref }}</span>
            <article>
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </article>
            @if($product->sizes->count() > 0)
                <div class="controls">
                    <div class="color">
                        <h5>Couleur</h5>
                        <ul>
                            <li><a href="#!" class="colors color-bdot1 active"></a></li>
                            <li><a href="#!" class="colors color-bdot2"></a></li>
                            <li><a href="#!" class="colors color-bdot3"></a></li>
                        </ul>
                    </div>
                    <div class="sizes">
                        <h5>Taille</h5>

                        <div class="select-menu">
                            <div class="select-btn">
                                <span class="sBtn-text">Sélectionner</span>
                                <svg role="img" viewBox="0 0 512 512">
                                    <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                                </svg>
                            </div>
                            <ul class="options">
                                @foreach($product->sizes as $size)
                                    <li class="option">
                                        <span class="option-text">
                                            {{ $size->size }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="qty">
                        <div class="select-menu">
                            <h5>Quantité</h5>
                            <div class="select-btn">
                                <span class="sBtn-text">Sélectionner</span>
                                <svg role="img" viewBox="0 0 512 512">
                                    <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                                </svg>
                            </div>
                            <ul class="options">
                                <li class="option"><span class="option-text">1</span></li>
                                <li class="option"><span class="option-text">2</span></li>
                                <li class="option"><span class="option-text">3</span></li>
                                <li class="option"><span class="option-text">4</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <button type="button">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                            <path d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                            <path d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                            <path d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                        </svg>                
                        <span>Acheter</span>
                    </button>
                </div>
            @else
                <div class="outOfStock">
                    <span>En rupture de stock</span>
                </div>
            @endif
        </div>
    </div>

    
    <div class="slider">
        <h2>Produits fréquemment achetés ensemble</h2>
        <div class="slide-track">
            @foreach($otherProducts as $otherProduct)
                <div class="slide">
                    @include('client.products.productCard', [ 'product' => $otherProduct])
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.footer')


    <script>
        
        function dropDownSizeSelector() {
            const optionMenu = document.querySelector(".sizes .select-menu"),
            selectBtn = optionMenu.querySelector(".sizes .select-btn"),
            options = optionMenu.querySelectorAll(".sizes .option"),
            sBtn_text = optionMenu.querySelector(".sizes .sBtn-text");

            selectBtn.addEventListener("click", () =>
                optionMenu.classList.toggle("active")
            );

            options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector(".sizes .option-text").innerText;
                sBtn_text.innerText = selectedOption;
                optionMenu.classList.remove("active");
            });
            });
        }
        function dropDownQtySelector() {
            const optionMenu = document.querySelector(".qty .select-menu"),
            selectBtn = optionMenu.querySelector(".qty .select-btn"),
            options = optionMenu.querySelectorAll(".qty .option"),
            sBtn_text = optionMenu.querySelector(".qty .sBtn-text");

            selectBtn.addEventListener("click", () =>
                optionMenu.classList.toggle("active")
            );

            options.forEach((option) => {
            option.addEventListener("click", () => {
                let selectedOption = option.querySelector(".qty .option-text").innerText;
                sBtn_text.innerText = selectedOption;
                optionMenu.classList.remove("active");
            });
            });
        }
        dropDownQtySelector();
        dropDownSizeSelector();

    </script>
</x-guest-layout>
