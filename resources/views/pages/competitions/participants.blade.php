@extends('layout.main')

@section('title', 'Список участников соревнований')

@section('content')
<competition-participants
    :competition="{{ $competition }}"
    :participants="{{ $participants }}"
    :is-secretary="{{ \App\Auth\ClientCertificateOrBasicAuthAuthenticator::isAuthenticated() ? 1 : 0 }}"
></competition-participants>
@endsection
