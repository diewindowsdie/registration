@extends('layout.main')

@section('title', 'Добавление соревнования')

@section('content')
<new-competition-form
    route-create="{{ route('competitions.create') }}"
    route-registration="{{ route('competitions.registrationForm', ':competition_id') }}"
    route-participants="{{ route('competitions.participants', ':competition_id') }}"
    route-load-upcoming-competitions="{{ route('competitions.loadUpcoming') }}"
    :divisions="{{ $divisions }}"
    :archery_classes="{{ $archery_classes }}"
    :qualifications="{{ $qualifications }}"
></new-competition-form>
@endsection
