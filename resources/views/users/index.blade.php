@extends('layouts.app')

@section('title')
  | Users
@endsection

@section('breadcrumb')
  <h1>Users
    <small>List</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }} "><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li>Users</li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="box">
      <div class="box-header">
        <i class="fa fa-users"></i>
        <h3 class="box-title">Users</h3>
        <div class="pull-right box-tools">
          <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-info">
              <i class="fa fa-user-plus"></i> Add User
            </button>
          </a>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-borded table-hover">
          <tr>
            <th>Full Name</th>
            <th>User Email</th>
            <th>Role</th>
            <th>Member Since</th>
          </tr>
          @forelse($users as $user)
            <tr>
              <td>
                <a href="{{ route('users.show', $user)}}">{{ $user->name }} </a>
              </td>
              <td>{{ $user->email }}</td>
              <td>{{ ucwords($user->role) }}</td>
              <td>{{ date('l, d F, Y', strtotime($user->created_at)) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4">No users found.></td>
            </tr>
          @endforelse
        </table>
      </div>
      <div class="box-footer clearfix">
        <div class="pagination pagination-sm no-margin pull-right">
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </section>
@endsection
