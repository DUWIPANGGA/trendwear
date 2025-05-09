<!-- resources/views/themes/indotoko/users/edit.blade.php -->
@extends('themes.indotoko.layouts.admin')

@section('title', 'Edit User')

@section('content')
    @include('themes.indotoko.users.form', ['user' => $user])
@endsection