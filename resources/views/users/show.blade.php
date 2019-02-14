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
		<div class="col-md-4">
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
							<b>Status</b><span class="pull-right">{{ $user->hasVerifiedEmail() ? ucwords($user->status) : 'Unverified' }}</span>
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
						<a href="{{ route('users.borrow', $user) }}">
							<button type="button" class="btn btn-info" onclick="event.preventDefault();document.getElementById('borrow-form').style.display = 'block';">Borrow a Book</button>
						</a>
                    </div>
                    <div id="borrow-form" class="row" style="margin-top: 20px; @if ($errors->any()) display: true @else display: none; @endif ">
						<form class="form" method="POST" action="{{ route('users.borrow', $user) }}">
							@csrf
							<div class="form-group col-md-8 {{ $errors->has('book_copy_id') ? 'has-error' : '' }}">
								<input type="text" autocomplete="off" placeholder="Book UUID" name="book_copy_id" class="form-control" value="{{ old('book_copy_id') }}" required>
					            @if ($errors->has('book_copy_id'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('book_copy_id') }}</strong>
					                </span>
					            @endif
							</div>
							<div class="btn-group col-md-4">
								<a>
									<button class="btn btn-sm btn-default pull-right" type="button" onclick="document.getElementById('borrow-form').style.display = 'none';">
										<i class="fa fa-remove"></i>
									</button>
								</a>
								<a>
									<button class="btn btn-sm btn-success pull-right" type="submit">
									Submit
									</button>
								</a>
							</div>
						</form>
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
