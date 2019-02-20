@extends('layouts.app')
@section('title')
  |Categories|Edit
@endsection

@section('breadcrumb')
  <h1>Categories
    <small>Edit</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li><a href="{{ route('categories.index') }}">Categories</a></li>
    <li>
      <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
    </li>
    <li><a href="javascript:">Edit</a></li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row text">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
          @include('categories.partials.form', ['method' => 'PUT', 'action' => route('categories.update', $category)])
        </div>
      </div>
    </div>
  </section>
@stop
