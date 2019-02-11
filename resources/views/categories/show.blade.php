@extends('layouts.app')

@section('title')
| Categories | {{ $category->name }}
@endsection

@section('breadcrumb')
<h1>Categories<small>{{ $category->name }}</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('categories.index') }}">Categories</a></li>
    <li><a href="javascript:">{{ $category->name }}</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	<div>
		<div class="btn-group pull-right">
			<a href="{{ route('categories.edit', $category) }}">
				<button class ="btn btn-warning"><i class="fa fa-edit"></i></button>
			</a>
			<a href="{{ route('categories.destroy', $category) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();"><button class="btn btn-danger"> <i class="fa fa-remove"></i></button>
			</a>
		</div>
		<h3>{{ $category->name }}</h3>
	</div>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab">Books</a></li>
			<li><a href="#tab_2" data-toggle="tab">Authors</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
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
								<td><a href="{{ route('books.show', $book)}}">{{ $book->name }} </a></td>
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
					<div class="box-footer clearfix">
					    <div class="pagination pagination-sm no-margin pull-right">
							{{ $books->links() }}
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane" id="tab_2">
				<div class="box-body">
					@forelse($authors as $author)
						<h4 class="col-md-3">
							<a href="{{ route('authors.show', $author) }}">{{ $author->name }}</a>
						</h4>
					@empty
						<h5 class="col-md-8">No authors found.</h5>
					@endforelse
					<div class="box-footer clearfix">
						<div class="pagination pagination-sm no-margin pull-right">
							{{ $authors->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div style="display: none;">
		<form id="delete-form" method="POST" action="{{ route('categories.destroy', $category) }}">
			@csrf
			@method('DELETE')
		</form>
	</div>
</section>
@endsection
