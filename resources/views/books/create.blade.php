@extends('layouts.app')

@section('title')
| Books | Create
@endsection

@section('breadcrumb')
<h1>Books <small>Create</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('books.index') }}">Books</a></li>
    <li><a href="javascript:">Create</a></li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="row text">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                @include('books.partials.form', ['method' => 'POST', 'action' => route('books.store')])
            </div>
        </div>
    </div>
</section>
@stop
