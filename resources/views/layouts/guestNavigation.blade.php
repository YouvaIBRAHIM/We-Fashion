<nav class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      WeFashion
    </div>
  </div>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
  
  <div class="nav-links">
        @php
            $categoriesCount = $categories->count();
            $limit = 4;
            $remainingCategoriesCount = $categoriesCount - $limit;
        @endphp

        @foreach($categories->take($limit) as $category)
            <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
        @endforeach

        @if($remainingCategoriesCount > 0)
            <div class="select-menu">
                <div class="select-btn">
                    <span class="sBtn-text">Voir plus</span>
                    <svg role="img" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                <ul class="options">
                    @foreach($categories->skip($limit) as $category)
                        <li class="option">
                            <a class="dropdown-item" href="{{ route('category.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
  </div>
</nav>