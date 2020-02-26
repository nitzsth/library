@extends('layouts.app')

@section('title')
  | Categories | Create
@endsection

@section('breadcrumb')
  <h1>Categories
    <small>Create</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li><a href="{{ route('categories.index') }}">Categories</a></li>
    <li><a href="javascript:">Create</a></li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row text">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary" id="category">
          @include('categories.partials.form', ['method' => 'POST', 'action' => route('categories.store')])
        </div>
      </div>
    </div>
  </section>
@stop

@section('scripts')
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
  <script src="{{ asset('js/category.js') }}"></script>

@endsection
