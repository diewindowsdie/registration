@extends('layout.main')

@section('title', $competition->title . ' (' . $competition->start_date->format('d.m.Y') . ' - ' . $competition->end_date->format('d.m.Y') . "): Список участников")

@section('content')
<competition-participants
    :competition="{{ $competition }}"
    :participants="{{ $participants }}"
    :is-secretary="{{ \App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated() }}"
></competition-participants>
@endsection
