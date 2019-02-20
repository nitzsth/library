<ul class="sidebar-menu tree" data-widget="tree">
  <li>
    <a href="{{ route('dashboard') }}">
      <i class="fa fa-dashboard"></i>
      <span>Dashboard</span>
    </a>
  </li>
  @if (auth()->user()->role === App\Helpers\Constant::ADMIN)
    <li>
      <a href="{{ route('users.index') }}">
        <i class="fa fa-users"></i>
        <span>Users</span>
      </a>
    </li>
  @endif
  <li>
    <a href="{{ route('books.index') }}">
      <i class="fa fa-book"></i>
      <span>Books</span>
    </a>
  </li>
  <li>
    <a href="{{ route('authors.index') }}">
      <i class="fa fa-pencil"></i>
      <span>Authors</span>
    </a>
  </li>
  <li>
    <a href="{{ route('categories.index') }}">
      <i class="fa fa-cubes"></i>
      <span>Categories</span>
    </a>
  </li>
</ul>
