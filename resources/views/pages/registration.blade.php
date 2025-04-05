@extends('layout.main')

@section('title', 'Регистрация')

@section('content')
    <registration route-save="{{ route('competitions.create') }}"></registration>
@endsection
