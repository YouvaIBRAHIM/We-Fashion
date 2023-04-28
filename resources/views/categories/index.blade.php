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

    @if (\Session::has('warning'))
        <div class="alert alert-warning">
            <ul>
                <li>{!! \Session::get('warning') !!}</li>
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-end my-2">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Réf</th>
            <th scope="col">Libellé</th>
            <th scope="col">Slug</th>
            <th scope="col"  class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoriesList as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{strtoupper($category->slug)}}

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
    {{ $categoriesList->links() }}
    
    @include('categories.deleteModal')

</x-app-layout>