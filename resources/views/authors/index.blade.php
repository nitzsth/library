@extends('layouts.app')

@section('title')
| Authors
@endsection

@section('breadcrumb')
<h1>Authors <small>List</small></h1>

<ol class="breadcrumb">
  <li><a href="{{ route('dashboard') }} "><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Authors</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="box">
      <div class="box-header">
        <i class="fa fa-authors"></i>
        <h3 class="box-title">Authors</h3>
        <div class="pull-right box-tools">
          <a href="{{ route('authors.create') }}"><button type="button" class="btn btn-info">
             <i class="fa fa-plus margin-r-5"></i> Add Author
           </button></a>
        </div>
      </div>
      <div class="box-body row">
          @forelse($authors as $author)
            <h4 class="col-md-3">
              <a href="{{ route('authors.show', $author) }}">{{ $author->name }}</a>
            </h4>
          @empty
            <h5 class="col-md-12">No authors found.</h5>
          @endforelse
      </div>
      <div class="box-footer clearfix">
        <div class="pagination pagination-sm no-margin pull-right">
          {{ $authors->links() }}
        </div>
      </div>
    </div>
</section>
@endsection
