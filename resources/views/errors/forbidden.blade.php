@extends('layout.main')

@section('title', __("registration.title"))

@section('content')
<p class="block mb-2 mt-2 text-8xl font-medium text-gray-900 dark:text-white">❌</p>
<p class="block mb-2 mt-10 text-3xl font-medium text-gray-900 dark:text-white">{{ __("errors.accessDeniedDetailed") }}</p>
@endsection
