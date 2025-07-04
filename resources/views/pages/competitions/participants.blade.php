@extends('layout.main')

@section('title', __("participants.title"))

@section('content')
<competition-participants
    :competition="{{ $competition }}"
    :participants="{{ $participants }}"
    :is-secretary="{{ \App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated() ? 1 : 0 }}"
    route-delete-participant="{{ route('competitions.deleteParticipant', ':participant_id') }}"
></competition-participants>
@endsection
