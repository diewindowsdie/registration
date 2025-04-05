@extends('layout.main')

@section('title', 'Добавить соревнование')

@section('content')
<new-competition-form route-create="{{ route('competitions.create') }}"></new-competition-form>
@endsection
