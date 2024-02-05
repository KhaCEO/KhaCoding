@extends('layout.app')

@section('menu')

    @include('components.menu')

@endsection

@section('content')

    @include('components.navbar')
    @include('components.subjects.assign.table')

@endsection
