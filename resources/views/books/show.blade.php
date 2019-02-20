@extends('layouts.app')

@section('title')
  | Books | {{ $book->name }}
@endsection

@section('breadcrumb')
  <h1>Books
    <small>{{ $book->name }}</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="javascript:">{{ $book->name }}</a></li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive"
                 src="{{ $book->avatar ?: asset('img/book-placeholder.png') }}"
                 alt="{{ $book->name }}">
            <h3 class="profile-bookname text-center">{{ $book->name }}</h3>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>ISBN</b>
                <span class="pull-right">{{ $book->isbn }}</span>
              </li>
              <li class="list-group-item">
                <b>Pages</b>
                <span class="pull-right">{{ $book->pages }}</span>
              </li>
              <li class="list-group-item">
                <b>Edition</b>
                <span class="pull-right">{{ $book->edition }}</span>
              </li>
              <li class="list-group-item">
                <b>Publisher</b>
                <span class="pull-right">{{ ucwords($book->publisher) }}</span>
              </li>
            </ul>
            @if (auth()->user()->role === App\Helpers\Constant::ADMIN)
              <div class="btn-group text-center">
                <a href="{{ route('books.upload', $book) }}">
                  <button type="button"
                          class="btn btn-warning"
                          onclick="event.preventDefault();document.getElementById('avatar').click();">
                    Upload Image
                  </button>
                </a>
                <a href="{{ route('books.edit', $book) }}">
                  <button type="button" class="btn btn-primary">
                    Edit
                  </button>
                </a>
                <a href="{{ route('books.destroy', $book) }}"
                   onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                  <button type="button" class="btn btn-danger">
                    Delete
                  </button>
                </a>
                <a href="{{ route('books.copy.store', $book) }}">
                  <button type="button"
                          class="btn btn-info"
                          onclick="event.preventDefault();document.getElementById('add-copy-form').style.display = 'block';">
                    Add a Copy
                  </button>
                </a>
              </div>
              <div id="add-copy-form"
                   class="row"
                   style="margin-top: 20px; @if ($errors->any()) display: true @else display: none; @endif ">
                <form class="form"
                      method="POST"
                      action="{{ route('books.copy.store', $book) }}">
                  @csrf
                  <div class="form-group col-md-8 {{ $errors->has('id') ? 'has-error' : '' }}">
                    <input type="text"
                           autocomplete="off"
                           placeholder="Book UUID"
                           name="id"
                           class="form-control"
                           value="{{ old('id') }}"
                           required>
                    @if ($errors->has('id'))
                      <span class="help-block">
						                    <strong>{{ $errors->first('id') }}</strong>
						                </span>
                    @endif
                  </div>
                  <div class="btn-group col-md-4">
                    <a>
                      <button class="btn btn-sm btn-default pull-right"
                              type="button"
                              onclick="document.getElementById('add-copy-form').style.display = 'none';">
                        <i class="fa fa-remove"></i>
                      </button>
                    </a>
                    <a>
                      <button class="btn btn-sm btn-success pull-right"
                              type="submit">
                        Add
                      </button>
                    </a>
                  </div>
                </form>
              </div>
              <p class="text-danger">
                @if ($errors->has('avatar'))
                  <strong>{{ $errors->first('avatar') }}</strong>
                @endif
              </p>
              <div style="display: none;">
                <form id="upload-form"
                      method="POST"
                      enctype="multipart/form-data"
                      action="{{ route('books.upload', $book) }}">
                  @csrf
                  <input type="file"
                         name="avatar"
                         id="avatar"
                         accept="image/*"
                         onchange="event.preventDefault();document.getElementById('upload-form').submit();">
                </form>
                <form id="delete-form"
                      method="POST"
                      action="{{ route('books.destroy', $book) }}">
                  @csrf
                  @method('DELETE')
                </form>
              </div>
            @endif
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info margin-r-5"></i> About
              Book</h3>
            <div class="box-body">
              <p class="text-justify">{{{ $book->description }}}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4><i class="fa fa-pencil margin-r-5"></i>Author(s)</h4>
          </div>
          <div class="box-body row">
            @forelse($book->authors as $author)
              <h4 class="col-md-6">
                <a href="{{ route('authors.show', $author) }}">{{ $author->name }}</a>
              </h4>
            @empty
              <h5 class="col-md-12">No authors found.</h5>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4><i class="fa fa-cubes margin-r-5"></i>Categories</h4>
          </div>
          <div class="box-body row">
            @forelse($book->categories as $category)
              <h4 class="col-md-6">
                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
              </h4>
            @empty
              <h5 class="col-md-12">No categories found.</h5>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h4><i class="fa fa-clone margin-r-5"></i>Copies</h4>
          </div>
          <div class="box-body">
            <table class="table table-borded table-hover">
              <tr>
                <th>Copy ID</th>
                <th>Status</th>
                <th>Date Added</th>
              </tr>
              @forelse($bookCopies as $bookCopy)
                <tr>
                  <td>
                    <a href="{{ route('book-copies.show', $bookCopy) }} ">
                      {{ $bookCopy->id }}
                    </a>
                  </td>
                  <td>
									<span class="badge bg-{{ $bookCopy->available ? 'green' : 'red' }}">
										{{ $bookCopy->available ? 'Available' : 'Unavailable'}}
									</span>
                  </td>
                  <td>{{ date('d F, Y', strtotime($bookCopy->created_at)) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="3">No books found.</td>
                </tr>
              @endforelse
            </table>
            <div class="box-footer clearfix">
              <div class="pagination pagination-sm no-margin pull-right">
                {{ $bookCopies->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
