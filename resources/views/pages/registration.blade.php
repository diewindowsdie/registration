@extends('layout.main')

@section('title', 'Регистрация')

@section('content')
    <competition-registration-form route-save="{{ route('competitions.create') }}"></competition-registration-form>
@endsection
