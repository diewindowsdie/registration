@extends('layout.main')

@section('title', 'Редактирование соревнования')

@section('content')
<new-competition-form
    :original-competition="{{ $competition }}"
    route-create="{{ route('competitions.create') }}"
    route-registration="{{ route('competitions.registrationForm', ':competition_id') }}"
    route-participants="{{ route('competitions.participants', ':competition_id') }}"
    route-load-upcoming-competitions="{{ route('competitions.loadUpcoming') }}"
    :divisions="{{ $divisions }}"
    :archery_classes="{{ $archery_classes }}"
></new-competition-form>
@endsection
