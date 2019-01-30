@extends('layouts.app')

@section('title')
 | Dashboard
@endsection

@section('breadcrumb')
<h1>Dashboard</h1>
<ol class="breadcrumb">
	<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
</ol>
@endsection