@extends('layout.main')

@section('title', __("registration.title"))

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
