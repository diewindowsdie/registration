<?php

namespace App\Auth;

class ClientCertificateOrBasicAuthAuthenticator
{
    private const SSL_CLIENT_S_DN_CN = "SSL_CLIENT_S_DN_CN";

    public static function getAuthenticatedUserName(): string|null
    {
        return request()->server(self::SSL_CLIENT_S_DN_CN);
    }

    public static function isAuthenticated(): bool
    {
        $user = self::getAuthenticatedUserName();
        return isset($user) && ($user !== '');
    }
}
