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
        <h3>{{ $category->name }}</h3>
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Books</a></li>
				<li><a href="#tab_2" data-toggle="tab">Authors</a></li>
				<div class="btn-group pull-right">
					<a href="{{ route('categories.edit', $category) }}"><button class ="btn btn-warning"><i class="fa fa-edit"></i></button></a>
					<a href="{{ route('categories.destroy', $category) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();"><button class="btn btn-danger"> <i class="fa fa-remove"></i></button> </a>
				</div>
            </ul>
            <div class="tab-content">
				<div class="tab-pane active" id="tab_1">
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
