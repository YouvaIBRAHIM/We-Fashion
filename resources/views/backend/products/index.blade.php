@section('title', $isTrashView ? 'Corbeille des produits - WeFashion' : 'Liste des produits - WeFashion')

<x-app-layout>
    @if ($isTrashView)
        <ol class="breadcrumb mt-3">
        <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Produits</a></li>
            <li class="breadcrumb-item active">Corbeille</li>
        </ol>
    @endif

    <h3 class="mt-4">Produits</h3>

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

    @if ($isTrashView)
        <form action="{{ route('product.multipleRestore') }}" method="POST">
            @csrf
    @endif
    
        <div class="d-flex justify-content-start my-2 btnContainer">
            @if (!$isTrashView)
                <a href="{{ route('product.create') }}" class="btn btn-primary mx-2">Ajouter un produit</a>
                <a href="{{ route('product.trash') }}" class="btn btn-secondary mx-2">Voir la corbeille</a>
            @else
                <button type="submit" class="btn btn-primary mx-2 multipleRestorationBtn" >
                    Multiple restauration
                </button>
            @endif
                <button type="button" class="btn btn-danger mx-2 multipleDeleteBtn"  data-toggle="modal" data-target="#multipleDeleteModal">
                    Suppression multiple
                </button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <input type="checkbox" id="selectAllColumns">
                        </th>
                        <th scope="col" class="text-center">Réf</th>
                        <th scope="col">Nom</th>
                        <th scope="col" class="text-center">Prix</th>
                        <th scope="col" class="text-center">État</th>
                        <th scope="col" class="text-center" style="width: 250px;">Catégories</th>
                        <th scope="col" class="text-center d-md-table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productsList as $product)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" value="{{$product->id}}" name="productIds[]" class="columnSelector" data-column="product-{{$product->id}}">
                            </td>
                            <td scope="row" class="text-center">{{$product->product_ref}}</td>
                            <td>{{$product->name}}</td>
                            <td class="text-center">{{$product->price}}€</td>
                            <td class="text-center">
                                <div class="alert {{$product->state == 'standard' ? 'alert-primary' : 'alert-warning'}} p-2 mb-0">
                                    {{strtoupper($product->state)}}
                                </div>
                            </td>
                            <td class="text-center" style="width: 250px;">
                                <div class="categories">
                                    @foreach($product->categories->take(3) as $category)
                                    <a href="{{ route('category.edit', $category->id) }}" target="_blank">
                                        <span class="category">
                                            {{ $category->name }}
                                        </span>
                                    </a>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center d-md-table-cell">
                                <div class="d-flex justify-content-around">
                                @if (!$isTrashView)
                                    <a href="{{ route('product.edit', $product->id) }}" class="edit" title="Éditer" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                                @else
                                    <form action="{{ route('product.restore', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn" title="Restaurer" data-toggle="tooltip"><i class="fa-solid fa-arrow-rotate-left text-primary"></i></button>
                                    </form>
                                @endif
                                    <button id="deleteButton" type="button" data-toggle="modal" data-target="#deleteModal"  data-product-id="{{ $product->id }}" data-product-ref="{{ $product->product_ref }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endForeach
                </tbody>
            </table>
        </div>

    @if ($isTrashView)
        </form>
    @endif
        <div class="mt-2 mb-4">
            {{ $productsList->links() }}
        </div>


    @include('backend.products.multipleDeleteModal')
    @include('backend.products.deleteModal')

    <script>
        // Script pour sélectionner toutes les colonnes
        const selectAllColumns = document.querySelector('#selectAllColumns');
        const columnSelectors = document.querySelectorAll('.columnSelector');

        const multipleRestorationBtn = document.querySelector('.multipleRestorationBtn');
        selectAllColumns.addEventListener('change', () => {
            if (selectAllColumns.checked === true) {
                if (multipleRestorationBtn) {
                    multipleRestorationBtn.classList.add('showMultipleRestorationBtn');
                }
                multipleDeleteBtn.classList.add('showMultipleDeleteBtn');
            }else{
                if (multipleRestorationBtn) {
                    multipleRestorationBtn.classList.remove('showMultipleRestorationBtn');
                }
                multipleDeleteBtn.classList.remove('showMultipleDeleteBtn');
            }
            let selectedLinesNumber = 0;
            columnSelectors.forEach(selector => {
                selector.checked = selectAllColumns.checked;
                selectedLinesNumber++;
            });
            multipleDeleteBtn.innerText = `Suppression multiple (${selectedLinesNumber})`;

            if (multipleRestorationBtn) {
                multipleRestorationBtn.innerText = `Restauration multiple (${selectedLinesNumber})`;
            }
        });

        tbody.addEventListener('click', (event) => {
            
            if (event.target.className == "columnSelector") {
                let isColumnSelected = false;
                let selectedLinesNumber = 0;
                columnSelectors.forEach(selector => {
                    if (selector.checked) {
                        isColumnSelected = true;
                        selectedLinesNumber++;
                    }
                });
                if (isColumnSelected) {
                    multipleDeleteBtn.innerText = `Suppression multiple (${selectedLinesNumber})`;
                    multipleDeleteBtn.classList.add('showMultipleDeleteBtn');
                    if (multipleRestorationBtn) {
                        multipleRestorationBtn.innerText = `Restauration multiple (${selectedLinesNumber})`;
                        multipleRestorationBtn.classList.add('showMultipleRestorationBtn');
                    }
                }else{
                    multipleDeleteBtn.classList.remove('showMultipleDeleteBtn');
                    if (multipleRestorationBtn) {
                        multipleRestorationBtn.classList.remove('showMultipleRestorationBtn');
                    }
                }


            }
        })
    </script>
</x-app-layout>