<!-- resources/views/themes/indotoko/products/edit.blade.php -->
@extends('themes.indotoko.layouts.admin')

@section('title', 'Edit Product')

@section('content')
    @include('themes.indotoko.product.form', ['product' => $product])
@endsection