@extends('layout.main')

@section('title', 'Регистрация на ' . $competition->title . ', ' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y'))

@section('content')
<competition-registration-form route-save="{{ route('competitions.register') }}"
                               route-find-athlete="{{ route('athletes.find') }}"
                               :competition="{{ $competition }}"
                               :qualifications="{{ $qualifications }}"
                               :regions="{{ $regions }}"
                               :sport_schools="{{ $sport_schools }}"
                               :sport_organisations="{{ $sport_organisations }}"
></competition-registration-form>
@endsection
