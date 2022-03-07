@extends('layouts.master')

@section('title', "Get Product Data" )

@section('header')
    @parent
    Get the product information from URL
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form method="POST" action="/mercadolibre/get-product-data" >
                @csrf
                <div class="form-group">
                    <label for="productUrl">Product URL</label>
                    <input class="form-control" type="text" name="productUrl" id="productUrl" placeholder="Set here the product URL" />
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Get Product Information</button>
            </form>
        </div>
    </div>
</div>

@stop
