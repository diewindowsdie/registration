@extends('layout.main')

@section('title', 'Добавление соревнований')

@section('content')
<new-competition-form
    route-create="{{ route('competitions.create') }}"
    route-registration="{{ route('competitions.registrationForm', ':competition_id') }}"
    route-participants="{{ route('competitions.participants', ':competition_id') }}"
    :divisions="{{ $divisions }}"
    :archery_classes="{{ $archery_classes }}"
></new-competition-form>
@endsection
