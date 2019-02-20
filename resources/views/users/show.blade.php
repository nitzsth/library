@extends('layouts.app')

@section('title')
  | Users | {{ $user->name }}
@endsection

@section('breadcrumb')
  <h1>Users
    <small>{{ $user->name }}</small>
  </h1>

  @if (auth()->user()->role === App\Helpers\Constant::ADMIN)
    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>
          Home</a></li>
      <li><a href="{{ route('users.index') }}">Users</a></li>
      <li><a href="javascript:">{{ $user->name }}</a></li>
    </ol>
  @endif
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle"
                 src="{{ $user->avatar ?: asset('img/avatar-placeholder.png') }}"
                 alt="{{ $user->name }}"
                 style="height: 100px">
            <h3 class="profile-username text-center">{{ $user->name }}</h3>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Email</b>
                <span class="pull-right">{{ $user->email }}</span>
              </li>
              <li class="list-group-item">
                <b>Role</b>
                <span class="pull-right">{{ ucwords($user->role) }}</span>
              </li>
              <li class="list-group-item">
                <b>Status</b>
                <span class="pull-right">{{ $user->hasVerifiedEmail() ? ucwords($user->status) : 'Unverified' }}</span>
              </li>
              <li class="list-group-item">
                <b>Member since</b>
                <span class="pull-right">{{ date('d F, Y', strtotime($user->created_at)) }}</span>
              </li>
            </ul>
            @if (auth()->user()->role === App\Helpers\Constant::ADMIN)
              <div class="btn-group text-center">
                <a href="{{ route('users.upload', $user) }}">
                  <button type="button"
                          class="btn btn-warning"
                          onclick="event.preventDefault();document.getElementById('avatar').click();">
                    Upload Avatar
                  </button>
                </a>
                <a href="{{ route('users.edit', $user) }}">
                  <button type="button" class="btn btn-primary">
                    Edit
                  </button>
                </a>
                <a href="{{ route('users.destroy', $user) }}"
                   onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                  <button type="button" class="btn btn-danger">
                    Delete
                  </button>
                </a>
                <a href="{{ route('users.borrow', $user) }}">
                  <button type="button"
                          class="btn btn-info"
                          onclick="event.preventDefault();document.getElementById('borrow-form').style.display = 'block';">
                    Borrow a Book
                  </button>
                </a>
              </div>
              <div id="borrow-form"
                   class="row"
                   style="margin-top: 20px; @if ($errors->has('book_copy_id')) display: true @else display: none; @endif ">
                @if($counts >= App\Helpers\Constant::MAX_BOOK_BORROW_LIMIT)
                  <div class="box-body">
                    <div class="alert alert-info alert-dismissible col-md-12">
                      <button class="btn btn-xs btn-info pull-right"
                              type="button"
                              onclick="document.getElementById('borrow-form').style.display = 'none';">
                        <i class="fa fa-remove"></i>
                      </button>
                      <h4><i class="icon fa fa-info"></i> Alert!</h4>
                      You have already borrowed 5 books. Please return any
                      previously borrowed book, and then try again.
                    </div>
                  </div>
                @else
                  <form class="form"
                        method="POST"
                        action="{{ route('users.borrow', $user) }}">
                    @csrf
                    <div class="form-group col-md-8 {{ $errors->has('book_copy_id') ? 'has-error' : '' }}">
                      <input type="text"
                             autocomplete="off"
                             placeholder="Book UUID"
                             name="book_copy_id"
                             class="form-control"
                             value="{{ old('book_copy_id') }}"
                             required>
                      @if ($errors->has('book_copy_id'))
                        <span class="help-block">
							                    <strong>{{ $errors->first('book_copy_id') }}</strong>
							                </span>
                      @endif
                    </div>
                    <div class="btn-group col-md-4">
                      <a>
                        <button class="btn btn-sm btn-default pull-right"
                                type="button"
                                onclick="document.getElementById('borrow-form').style.display = 'none';">
                          <i class="fa fa-remove"></i>
                        </button>
                      </a>
                      <a>
                        <button class="btn btn-sm btn-success pull-right"
                                type="submit">
                          Submit
                        </button>
                      </a>
                    </div>
                  </form>
                @endif
              </div>
              <p class="text-danger">
                @if ($errors->has('avatar'))
                  <strong>{{ $errors->first('avatar') }}</strong>
                @endif
              </p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header">
            <h4>
              <i class="fa fa-history margin-r-5"></i>Borrowed History
              <span class="pull-right">
							Paid fine : <span class="badge bg-green">Rs. {{ $paidFine }}/-</span>&nbsp;&nbsp;
							Active fine : <span class="badge bg-red">Rs. {{ $activeFine }}/-</span>
						</span>
            </h4>
          </div>
          <div class="box-body">
            <table class="table table-border table-hover">
              <tr>
                <th>Book UUID</th>
                <th>Book Name</th>
                <th>Borrowed Date/Time</th>
                <th>Returned Date/Time</th>
                <th>Fine</th>
              </tr>
              @forelse($bookCopies as $bookCopy)
                <tr>
                  <td>
                    <a href="{{ route('book-copies.show', $bookCopy) }}"> {{ $bookCopy->id }}</a>
                  </td>
                  <td>
                    <a href="{{ route('books.show', $bookCopy->book) }}">{{ $bookCopy->book->name }}</a>
                  </td>
                  <td>{{ date('d F, Y / H:i:s', strtotime($bookCopy->pivot->borrowed_date)) }}</td>
                  <td>@if($bookCopy->pivot->returned_date == null)
                      @if(auth()->user()->role === App\Helpers\Constant::ADMIN)
                        <a href="{{ route('users.books.copy.return', [$user, $bookCopy]) }} ">
                          <button type="button"
                                  class="btn btn-xs btn-success"
                                  onclick="event.preventDefault();document.getElementById('book-return-form-{{ $bookCopy->id }}').style.display = 'block';">
                            <i class="fa fa-repeat margin-r-5"></i>
                            <span>Return Book</span>
                          </button>
                        </a>
                        <div id="book-return-form-{{ $bookCopy->id }}"
                             class="row"
                             style="width: 200px; margin: 0px; @if ($errors->has('fine') && old('book_copy_id') === $bookCopy->id) display: true @else display: none; @endif ">
                          <form method="POST"
                                action="{{ route('users.books.copy.return', [$user, $bookCopy]) }}">
                            @csrf
                            <div class="form-group {{ $errors->has('fine') && old('book_copy_id') === $bookCopy->id ? 'has-error' : '' }}">
                              <input type="hidden"
                                     name="book_copy_id"
                                     value="{{ $bookCopy->id }}">
                              <input class="form-group col-md-4"
                                     type="integer"
                                     name="fine"
                                     value="{{ $bookCopy->pivot->fine }}"
                                     autocomplete="off"
                                     required>
                              <div class="btn-group col-md-5">
                                <a>
                                  <button class="btn btn-xs btn-default pull-right"
                                          type="button"
                                          onclick="document.getElementById('book-return-form-{{ $bookCopy->id }}').style.display = 'none';">
                                    <i class="fa fa-remove"></i>
                                  </button>
                                </a>
                                <a>
                                  <button class="btn btn-xs btn-success pull-right"
                                          type="submit">
                                    <i class="fa fa-check"></i>
                                  </button>
                                </a>
                              </div>
                              @if ($errors->has('fine') && old('book_copy_id') === $bookCopy->id)
                                <span class="help-block">
																<strong class="pull-left text-justify">{{ $errors->first('fine') }}</strong>
															</span>
                              @endif
                            </div>
                          </form>
                        </div>
                      @else Not Returned.
                      @endif

                    @else{{ date('d F, Y / H:i:s', strtotime($bookCopy->pivot->returned_date)) }}@endif
                  </td>
                  <td>Rs. {{ $bookCopy->pivot->fine }}/-</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5">You have not borrowed any book yet.</td>
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

    <div style="display: none;">
      <form id="upload-form"
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('users.upload', $user) }}">
        @csrf
        <input type="file"
               name="avatar"
               id="avatar"
               accept="image/*"
               onchange="event.preventDefault();document.getElementById('upload-form').submit();">
      </form>
      <form id="delete-form"
            method="POST"
            action="{{ route('users.destroy', $user) }}">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </section>
@endsection
