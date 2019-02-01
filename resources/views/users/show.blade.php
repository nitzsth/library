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
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
