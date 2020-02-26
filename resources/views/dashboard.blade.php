@extends('layouts.app')

@section('title')
  | Dashboard
@endsection

@section('breadcrumb')
  <h1>Dashboard</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Dashboard</li>
  </ol>
@endsection

@section('content')
  <div class="col-md-8 col-md-offset-2 text-center">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><strong>New Arrivals</strong></h3>
      </div>

      <div class="box-body" style="background: #0f0f0f">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($books as $book)
              <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
          </ol>
          <div class="carousel-inner text-center">
            @foreach($books as $book)
              <div class="item {{ $loop->first ? 'active' : '' }}">
                <a href="{{ route('books.show', $book) }}">
                  <img src="{{ $book->avatar}}" alt="First slide" style="width: 100%; height: 426px; object-fit: cover">
                </a>
                <div class="carousel-caption">
                  <badge class="label bg-gray">{{ $book->name }}</badge>
                </div>
              </div>
            @endforeach
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
