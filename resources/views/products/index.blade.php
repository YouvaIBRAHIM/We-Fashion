<x-app-layout>
    <style>
        .multipleDeleteBtn{
            display: none;
        }
        .showMultipleDeleteBtn{
            display: flex!important;
        }
    </style>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
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

        <div class="d-flex justify-content-start my-2">
            <a href="{{ route('product.create') }}" class="btn btn-primary mx-2">Ajouter un produit</a>
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
                    <th scope="col" class="text-center">Nom</th>
                    <th scope="col" class="text-center">État</th>
                    <th scope="col" class="text-center">Visibilité</th>
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
                        <td class="text-center">{{$product->name}}</td>
                        <td class="text-center">{{strtoupper($product->state)}}</td>
                        <td class="text-center">
                            <span class="{{$product->is_visible ? 'text-success' : 'text-danger'}}">{{$product->is_visible ? "Publié" : "Non publié"}}</span>
                        </td>
                        <td class="text-center d-md-table-cell">
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
    </div>
    {{ $productsList->links() }}

    @include('products.multipleDeleteModal')
    @include('products.deleteModal')

    <script>
        // Script pour sélectionner toutes les colonnes
        const selectAllColumns = document.querySelector('#selectAllColumns');
        const columnSelectors = document.querySelectorAll('.columnSelector');

        selectAllColumns.addEventListener('change', () => {
            if (selectAllColumns.checked === true) {
                multipleDeleteBtn.classList.add('showMultipleDeleteBtn');
            }else{
                multipleDeleteBtn.classList.remove('showMultipleDeleteBtn');
            }
            columnSelectors.forEach(selector => {
                selector.checked = selectAllColumns.checked;
            });
        });

        tbody.addEventListener('click', (event) => {
            
            if (event.target.className == "columnSelector") {
                let isColumnSelected = false;
                columnSelectors.forEach(selector => {
                    if (selector.checked) {
                        isColumnSelected = true;
                    }
                });
                if (isColumnSelected) {
                    multipleDeleteBtn.classList.add('showMultipleDeleteBtn');
                }else{
                    multipleDeleteBtn.classList.remove('showMultipleDeleteBtn');
                }
            }
        })
    </script>
</x-app-layout>