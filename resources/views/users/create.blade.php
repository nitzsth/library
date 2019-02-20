@extends('layouts.app')

@section('title')
  | Users | Create
@endsection

@section('breadcrumb')
  <h1>Users
    <small>Create</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="javascript:">Create</a></li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row text">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
          @include('users.partials.form', ['method' => 'POST', 'action' => route('users.store')])
        </div>
      </div>
    </div>
  </section>
@stop
