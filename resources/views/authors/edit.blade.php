@extends('layouts.app')
@section('title')
| Authors | Edit
@endsection

@section('breadcrumb')
<h1>Authors <small>Edit</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('authors.index') }}">Authors</a></li>
    <li><a href="{{ route('authors.show', $author) }}">{{ $author->name }}</a></li>
    <li><a href="javascript:">Edit</a></li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="row text">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                @include('authors.partials.form', ['method' => 'PUT', 'action' => route('authors.update', $author)])
            </div>
        </div>
    </div>
</section>
@stop
