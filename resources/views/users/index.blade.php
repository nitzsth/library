@extends('layouts.app')

@section('title')
| Users
@endsection

@section('breadcrumb')
<h1>User <small>List</small></h1>

<ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }} "><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('users.index') }} ">Users</a></li>
      </ol>
@endsection

@section('content')
<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <tr>
      <th>User Name</th>
      <th>User Email</th>
      <th>Role</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td><a href="{{ route('users.show', $user)}}">{{ $user->name }} </a></td>
      <td>{{$user->email}}</td>
      <td>{{$user->role}}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection