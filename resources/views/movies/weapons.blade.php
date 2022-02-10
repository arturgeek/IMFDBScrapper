@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    {{ $movieCleanName }}
@stop

@section('content')
    @foreach ( $categories as $category => $weapons )
    <div class="weapons-category">
        <h2>{{ $category }}</h2>
        <hr class="col-12 mb-5 mt-5">
        @include('layouts.weaponsgrid', ['weapons' => $weapons, 'addToFavoriteButton' => true]);
    </div>
    @endforeach
@stop
