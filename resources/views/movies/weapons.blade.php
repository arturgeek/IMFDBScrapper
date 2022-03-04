@extends('layouts.master')

@section('title', "Weapons of $movieCleanName" )

@section('header')
    @parent
    {{ $movieCleanName }}
@stop

@section('subheader')
    @parent
    Here is the list of weapons fr this movie
@stop

@section('content')
    @foreach ( $categories as $category => $weapons )
    <div class="weapons-category">
        <h2>{{ $category }}</h2>
        <hr class="col-12 mb-3 mt-3">
        @include('layouts.weaponsgrid', ['weapons' => $weapons, 'addToFavoriteButton' => true]);
    </div>
    @endforeach
@stop
