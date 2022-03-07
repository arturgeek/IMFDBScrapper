@extends('layouts.master')

@section('title', "Data of $productCleanName" )

@section('header')
    @parent
    {{ $productCleanName }}
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            @foreach ( $productData as $title => $object )

            <div class="product-panel product-{{$title}}" >
                <h2>{{  ucfirst(trans($title)) }}</h2>

                @if ( is_array( $object ) )

                <div class="collection">

                    @foreach ( $object as $itemKey => $itemValue )

                        @if ( $title === "images" )
                            <div class="img-container">
                                <img src="{{ $itemValue }}" />
                            </div>

                        @elseif ( is_array( $itemValue ) )

                            <div>

                                @if( !is_numeric($itemKey) )
                                <h4>
                                    {{ $itemKey }}
                                </h4>
                                @endif

                                @foreach ( $itemValue as $value )

                                <div>
                                    {{ $value }}
                                </div>

                                @endforeach

                            </div>

                        @else

                            <div>
                                {{ $itemValue }}
                            </div>

                        @endif

                    @endforeach

                </div>

                @else

                    <span class="single-value">
                        {{ $object }}
                    </span>

                @endif

            </div>

            @endforeach

        </div>
    </div>
</div>

@stop
