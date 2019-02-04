@extends('layouts.app')

@section('title')
| Users | {{ $user->name }}
@endsection

@section('breadcrumb')
<h1>Users<small>{{ $user->name }}</small></h1>

<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="javascript:">{{ $user->name }}</a></li>
</ol>
@endsection

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar ?: asset('img/avatar-placeholder.png') }}" alt="{{ $user->name }}" style="height: 100px">
					<h3 class="profile-username text-center">{{ $user->name }}</h3>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Email</b><span class="pull-right">{{ $user->email }}</span>
						</li>
						<li class="list-group-item">
							<b>Role</b><span class="pull-right">{{ ucwords($user->role) }}</span>
						</li>
						<li class="list-group-item">
							<b>Member since</b><span class="pull-right">{{ date('d F, Y', strtotime($user->created_at)) }}</span>
						</li>
					</ul>
					<div class="btn-group text-center">
                  		<a href="{{ route('users.upload', $user) }}">
                    		<button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('avatar').click();">
                      			Upload Avatar
                    		</button>
                    	</a>
                  		<a href="{{ route('users.edit', $user) }}">
                    		<button type="button" class="btn btn-primary">
                      			Edit
                    		</button>
                    	</a>
						<a href="{{ route('users.destroy', $user) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                    		<button type="button" class="btn btn-danger">
                      			Delete
                    		</button>
                    	</a>
                    </div>
                    <p class="text-danger">
		                @if ($errors->has('avatar'))
	                        <strong>{{ $errors->first('avatar') }}</strong>
		                @endif
	                </p>
				</div>
			</div>
		</div>
	</div>

	<div style="display: none;">
	    <form id="upload-form" method="POST" enctype="multipart/form-data" action="{{ route('users.upload', $user) }}">
			@csrf
	        <input type="file" name="avatar" id="avatar" accept="image/*" onchange="event.preventDefault();document.getElementById('upload-form').submit();">
		</form>
		<form id="delete-form" method="POST" action="{{ route('users.destroy', $user) }}">
			@csrf
			@method('DELETE')
		</form>
	</div>
</section>
@endsection
