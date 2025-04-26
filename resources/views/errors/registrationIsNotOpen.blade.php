@extends('layout.main')

@section('title', 'Регистрация на ' . $competition->title . ', ' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y'))

@section('content')
<p class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Регистрация открыта с {{$competition->registration_start->format('d.m.Y H:i:s')}} по {{$competition->registration_finish->format('d.m.Y H:i:s')}}</p>
<p class="block mb-2 mt-10 text-3xl font-medium text-gray-900 dark:text-white">В данный момент регистрация на соревнование недоступна.</p>
@endsection
