@extends('layouts.master')

@section('title', 'IMFDB Scrapper')

@section('header')
    <h2>Search your favorite wapons from the Internet Movie Firearms Database</h2>
    <p>You can start searching by your favorite movies, we already added some examples for you from own our list..</p>
    <ul class="icon-list">
        <li><a href="{{ url('imfdb/weapons?movie=Captain_America:_The_First_Avenger') }}">Captain America: The First Avenger</a></li>
        <li><a href="{{ url('imfdb/weapons?movie=Captain_America:_The_Winter_Soldier') }}">Captain America: The Winter Soldier</a></li>
    </ul>
@stop

@section('subheader')
    @section('sidebar')
    <h1>
        The weapons of @show
    </h1>
@stop
