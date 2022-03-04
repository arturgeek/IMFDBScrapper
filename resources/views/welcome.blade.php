@extends('layouts.master')

@section('title', 'Scrapper Tool')

@section('header')
    @parent Here will be your scrapping tools
@stop

@section('subheader')
    @parent Choose the tool.
@stop

@section('content')

    <div class="row row-cols-1 row-cols-sm-2 g-2">

        <div class="col w-100">
            <a href="/imfdb" class="btn btn-dark">Go to IMFDB tool</a>
            <br/>
            <br/>
            <a href="/imfdb" class="btn btn-dark">Go to Mercadolibre tool</a>
        </div>

    </div>
@stop
