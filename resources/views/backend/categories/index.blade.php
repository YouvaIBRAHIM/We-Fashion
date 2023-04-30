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
    <h3 class="mt-4">Catégories</h3>

    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    @if (\Session::has('warning'))
        <div class="alert alert-warning alert-dismissible">
            <ul>
                <li>{!! \Session::get('warning') !!}</li>
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-start my-2">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
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
                    <th scope="col">Réf</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Nombre de produits associés</th>
                    <th scope="col">Slug</th>
                    <th scope="col"  class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoriesList as $category)
                    <tr>
                        <th class="text-center">
                            <input type="checkbox" value="{{$category->id}}" name="categoryIds[]" class="columnSelector" data-column="category-{{$category->id}}">
                        </th>
                        <td scope="row">{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->products_count}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="{{ route('category.edit', $category->id) }}" class="edit" title="Éditer" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                                <button id="deleteButton" type="button" data-toggle="modal" data-target="#deleteModal"  data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endForeach

            </tbody>
        </table>
        </div>
    
    {{ $categoriesList->links() }}
    
    @include('backend.categories.deleteModal')
    @include('backend.categories.multipleDeleteModal')

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
            let selectedLinesNumber = 0;
            columnSelectors.forEach(selector => {
                selector.checked = selectAllColumns.checked;
                selectedLinesNumber++;
            });
            multipleDeleteBtn.innerText = `Suppression multiple (${selectedLinesNumber})`;
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
                }else{
                    multipleDeleteBtn.classList.remove('showMultipleDeleteBtn');
                }
            }
        })
    </script>
</x-app-layout>