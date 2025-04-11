@extends('layout.main')

@section('title', 'Регистрация на ' . $competition->title . ', ' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y'))

@section('content')
<competition-registration-form route-save="{{ route('competitions.register') }}"
                               route-find-athlete="{{ route('athletes.find') }}"
                               route-find-region="{{ route('regions.find') }}"
                               :competition="{{ $competition }}"
                               :divisions="{{ $divisions }}"
                               :archery_classes="{{ $archery_classes }}"
></competition-registration-form>
@endsection
