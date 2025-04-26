@extends('layout.main')

@section('title', 'Добавить соревнование')

@section('content')
<new-competition-form
    route-create="{{ route('competitions.create') }}"
    :divisions="{{ $divisions }}"
    :archery_classes="{{ $archery_classes }}"
></new-competition-form>
@endsection
