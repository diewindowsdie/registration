@extends('layout.main')

@section('title', $competition->title . ' (' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y') . "): Список участников")

@section('content')
<competition-participants
    :competition="{{ $competition }}"
    :participants="{{ $participants }}"
></competition-participants>
@endsection
