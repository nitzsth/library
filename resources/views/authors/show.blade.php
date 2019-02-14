@extends('layouts.app')

@section('title')
| Authors | {{ $author->name }}
@endsection

@section('breadcrumb')
<h1>Authors<small>{{ $author->name }}</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('authors.index') }}">Authors</a></li>
    <li><a href="javascript:">{{ $author->name }}</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="{{ $author->avatar ?: asset('img/avatar-placeholder.png') }}" alt="{{ $author->name }}" style="height: 100px">
					<h3 class="profile-username text-center">{{ $author->name }}</h3>
					<p class="text-center text-muted">
						{{ $author->birth }}-{{ $author->death }}
					</p>
					<div class="btn-group text-center">
                  		<a href="{{ route('authors.upload', $author) }}">
                    		<button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('avatar').click();">
                      			Upload Avatar
                    		</button>
                    	</a>
                  		<a href="{{ route('authors.edit', $author) }}">
                    		<button type="button" class="btn btn-primary">
                      			Edit
                    		</button>
                    	</a>
						<a href="{{ route('authors.destroy', $author) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                    		<button type="button" class="btn btn-danger">
                      			Delete
                    		</button>
                    	</a>
                    </div>
                    <p class="text-danger">
		                @if ($errors->has('avatar'))
	                        <strong>{{ $errors->first('avatar') }}</strong>
		                @endif
	                </p>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-info margin-r-5"></i> About Author</h3>
					<div class="box-body">
						<p class="text-justify">{{ $author->description }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4><i class="fa fa-book margin-r-5"></i>Book(s)</h4>
				</div>
				<div class="box-body row">
					@forelse($author->books as $book)
						<h4 class="col-md-3">
							<a href="{{ route('books.show', $book) }}">{{ $book->name }}</a>
						</h4>
					@empty
						<h5 class="col-md-8">No books found.</h5>
					@endforelse
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header with-border">
					<h4><i class="fa fa-cubes margin-r-5"></i>Categories</h4>
				</div>
				<div class="box-body row">
					@forelse($author->categories as $category)
						<h4 class="col-md-3">
							<a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
						</h4>
					@empty
						<h5 class="col-md-8">No categories found.</h5>
					@endforelse
				</div>
			</div>
		</div>


	</div>

	<div style="display: none;">
	    <form id="upload-form" method="POST" enctype="multipart/form-data" action="{{ route('authors.upload', $author) }}">
			@csrf
	        <input type="file" name="avatar" id="avatar" accept="image/*" onchange="event.preventDefault();document.getElementById('upload-form').submit();">
		</form>
		<form id="delete-form" method="POST" action="{{ route('authors.destroy', $author) }}">
			@csrf
			@method('DELETE')
		</form>
	</div>
</section>
@endsection
