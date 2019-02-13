@extends('layouts.app')

@section('title')
| Books | {{ $bookCopy->book->name }} |{{ $bookCopy->id }}
@endsection

@section('breadcrumb')
<h1>Books<small>Copy id : {{ $bookCopy->id }}</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="{{ route('books.show', $bookCopy->book) }}">{{ $bookCopy->book->name}} </a></li>
    <li><a href="javascript:">Copy id : {{ $bookCopy->id }}</a></li>
</ol>
@endsection

@section('content')
<section>
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive" src="{{ $bookCopy->book->avatar ?: asset('img/book-placeholder.png') }}" alt="{{ $bookCopy->book->name }}">
					<h3 class="profile-bookname text-center">{{ $bookCopy->book->name }}</h3>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Copy ID</b><span class="pull-right">{{ $bookCopy->id }}</span>
						</li>
						<li class="list-group-item">
							<b>ISBN</b><span class="pull-right">{{ $bookCopy->book->isbn }}</span>
						</li>
						<li class="list-group-item">
							<b>Pages</b><span class="pull-right">{{ $bookCopy->book->pages }}</span>
						</li>
						<li class="list-group-item">
							<b>Edition</b><span class="pull-right">{{ $bookCopy->book->edition }}</span>
						</li>
						<li class="list-group-item">
							<b>Publisher</b><span class="pull-right">{{ ucwords($bookCopy->book->publisher) }}</span>
						</li>
					</ul>
					<div class="btn-group text-center">
                  		<a href="{{ route('book-copies.update', $bookCopy) }} ">
                    		<button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('edit-copy-form').style.display = 'block';">
                      			Edit
                    		</button>
                    	</a>
                    </div>
                    <div id="edit-copy-form" class="row" style="margin-top: 20px; @if ($errors->any()) display: true @else display: none; @endif ">
                    	<form class="form" method="POST" action="{{ route('book-copies.update', $bookCopy) }} ">
                    		@csrf
                    		@method('PUT')
                    		<div class="form-group col-md-8 {{ $errors->has('id') ? 'has-error' : '' }}">
								<input type="text" autocomplete="off" placeholder="Book copy UUID" name="id" class="form-control" value="{{ old('id') ?? $bookCopy->id }}" required>
					            @if ($errors->has('id'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('id') }}</strong>
					                </span>
					            @endif
							</div>
							<div class="btn-group col-md-4">
								<a>
									<button class="btn btn-sm btn-default pull-right" type="button" onclick="document.getElementById('edit-copy-form').style.display = 'none';">
										<i class="fa fa-remove"></i>
									</button>
								</a>
								<a>
									<button class="btn btn-sm btn-success pull-right" type="submit">
									Change
									</button>
								</a>
							</div>
                    	</form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
