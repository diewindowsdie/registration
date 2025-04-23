@extends('layout.main')

@section('title', 'Регистрация на ' . $competition->title . ' (' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y') . ')'
. ", открыта с " . $competition->registration_start->format('d.m.Y H:i:s') . " по " . $competition->registration_finish->format('d.m.Y H:i:s'))

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
