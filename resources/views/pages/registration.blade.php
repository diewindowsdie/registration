@extends('layout.main')

@section('title', 'Регистрация')

@section('content')
    <registration route-save="{{ route('athletes.save') }}"></registration>
@endsection
