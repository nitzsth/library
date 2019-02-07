@extends('layouts.app')
@section('title')
|Books|Edit
@endsection

@section('breadcrumb')
<h1>Books <small>Edit</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="{{ route('books.show', $book) }}">{{ $book->name }}</a></li>
    <li><a href="javascript:">Edit</a></li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="row text">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
            	@include('books.partials.form', ['method' => 'PUT', 'action' => route('books.update', $book)])
            </div>
        </div>
    </div>
</section>
@stop
