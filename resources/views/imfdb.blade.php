@extends('layouts.weapons-master')

@section('title', 'Page Title')

@section('sidebar')
    @parent your favorites movies will appear here.
@stop

@section('content')

    <br/>
    <br/>

    <div class="row row-cols-1 row-cols-sm-2 g-2">

        <div class="col @if ( count($favorites) > 0 ) w-100 @endif">
            @if ( count($favorites) === 0 )
            You do not have current favorites, add some new ones!!!.
            @else
            <h3>Your favorites</h3>
            @include('layouts.weaponsgrid', ['weapons' => $favorites, 'addToFavoriteButton' => false ]);
            @endif
        </div>

        @if ( count($featured) > 0 )
        <div class="col imfdb-fatured-article">
            <h3>Featured Movie</h3>
            <div class="card shadow-sm">
                @if ( $featured["image_url"] !== "" )
                <img class="bd-placeholder-img card-img-top" role="img" src="{{ $featured["image_url"] }}" />
                @endif
                <div class="card-body">
                    <a href="{{ url('movie-weapons?movie='.$featured["url"].'') }}">
                        Weapons of {{ $featured["name"] }}
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
@stop
