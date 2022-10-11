@extends('products.layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 margin-tb">

        <div class="pull-left">
            <h2> Show Product</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Details:</strong>
                    {{ $product->detail }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Created At:</strong>
                    {{ $product->created_at }}
                </div>
            </div>

        </div>

    </div>
</div @endsection