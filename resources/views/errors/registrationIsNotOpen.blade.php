@extends('layout.main')

@section('title', __("registration.title"))

@section('content')
<p class="block mb-2 text-5xl font-bold text-gray-900 dark:text-white">{{ $competition->title }},
    {{ $competition->start_date->format("d.m.Y") }} - {{ $competition->end_date->format("d.m.Y") }}</p>
<p class="block mb-2 mt-4 text-3xl font-medium text-gray-900 dark:text-white">{{ __("registration.registrationOpenTitle") }} {{ __("general.dateFrom") }}
    <b>{{$competition->registration_start->format('d.m.Y H:i:s')}}</b> {{ __("general.dateTo") }} <b>{{$competition->registration_finish->format('d.m.Y H:i:s')}}</b></p>
<p class="block mb-2 mt-10 text-3xl font-medium text-gray-900 dark:text-white">{{ __("errors.registrationNotAvailable") }}</p>
@endsection
