@extends('layout.main')

@section('title', 'Список соревнований')

@section('content')
<a href="{{ route('competitions.new') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Регистрация</a>
@foreach($competitions as $competition)
    <competition :data="{{ $competition }}"></competition>
@endforeach
@endsection
