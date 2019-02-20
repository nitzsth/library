@extends('layouts.app')

@section('title')
  | Books
@endsection

@section('breadcrumb')
  <h1>Books
    <small>List</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }} "><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li>Books</li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="box">
      <div class="box-header">
        <i class="fa fa-books"></i>
        <h3 class="box-title">Books</h3>
        @if (auth()->user()->role === App\Helpers\Constant::ADMIN)
          <div class="pull-right box-tools">
            <a href="{{ route('books.create') }}">
              <button type="button" class="btn btn-info">
                <i class="fa fa-plus margin-r-5"></i> Add Book
              </button>
            </a>
          </div>
        @endif
      </div>
      <div class="box-body">
        <table class="table table-borded table-hover">
          <tr>
            <th>Book Name</th>
            <th>Isbn</th>
            <th>Pages</th>
            <th>Edition</th>
            <th>Publisher</th>
          </tr>
          @forelse($books as $book)
            <tr>
              <td>
                <a href="{{ route('books.show', $book)}}">{{ $book->name }} </a>
              </td>
              <td>{{ $book->isbn }}</td>
              <td>{{ $book->pages }}</td>
              <td>{{ $book->edition }}</td>
              <td>{{ ucwords($book->publisher) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5">No books found.</td>
            </tr>
          @endforelse
        </table>
      </div>
      <div class="box-footer clearfix">
        <div class="pagination pagination-sm no-margin pull-right">
          {{ $books->links() }}
        </div>
      </div>
    </div>
  </section>
@endsection
