<!-- resources/views/themes/indotoko/products/edit.blade.php -->
@extends('themes.indotoko.layouts.admin')

@section('title', 'Edit Orders')

@section('content')
    @include('themes.indotoko.orders.form', ['orders' => $orders])
@endsection