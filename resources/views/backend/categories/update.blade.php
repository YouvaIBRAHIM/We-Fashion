@section('title', 'Édition de la catégorie '. $category->name .' - WeFashion')

<x-app-layout>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Catégories</a></li>
        <li class="breadcrumb-item active">Fiche</li>
    </ol>
    <h3 class="mt-4">Fiche catégorie</h3>
    
    @include('backend.categories.form')
</x-app-layout>