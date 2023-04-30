@section('title', 'Nouvelle catégorie - WeFashion')

<x-app-layout>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Catégories</a></li>
        <li class="breadcrumb-item active">Création</li>
    </ol>
    <h3 class="mt-4">Nouvelle catégorie</h3>
    
    @include('backend.categories.form')
</x-app-layout>