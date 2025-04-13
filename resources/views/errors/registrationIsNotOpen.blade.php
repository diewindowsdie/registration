@extends('layout.main')

@section('title', 'Регистрация на ' . $competition->title . ', ' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y'))

@section('content')
сделать даты регистрации
<p>Регистрация на соревнование недоступна</p>
@endsection
