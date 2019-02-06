@extends('layouts.app')

@section('title')
| Categories
@endsection

@section('breadcrumb')
<h1>Categories <small>List</small></h1>

<ol class="breadcrumb">
  <li><a href="{{ route('dashboard') }} "><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Categories</li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="box">
    <div class="box-header">
      <i class="fa fa-cubes"></i>
      <h3 class="box-title">Categories</h3>
      <div class="pull-right box-tools">
        <a href="{{ route('categories.create') }}"><button type="button" class="btn btn-info">
           <i class="fa fa-plus margin-r-5"></i> Add category
         </button></a>
      </div>
    </div>
    <div class="box-body row">
        @forelse($categories as $category)
          <h4 class="col-md-3">
            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
          </h4>
        @empty
          <h5 class="col-md-12">No categories found.</h5>
        @endforelse
    </div>
    <div class="box-footer clearfix">
      <div class="pagination pagination-sm no-margin pull-right">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
</section>
@endsection
