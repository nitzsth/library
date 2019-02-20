@extends('layouts.app')
@section('title')
  | Users | Edit
@endsection

@section('breadcrumb')
  <h1>Users
    <small>Edit</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
    <li><a href="javascript:">Edit</a></li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row text">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
          @include('users.partials.form', ['method' => 'PUT', 'action' => route('users.update', $user)])
        </div>
      </div>
    </div>
  </section>
@stop
