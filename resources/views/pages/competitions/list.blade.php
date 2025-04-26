@extends('layout.main')

@section('title', 'Список соревнований')

@section('content')
@foreach($competitions as $competition)
    <competition :data="{{ $competition }}"></competition>
@endforeach
@endsection
