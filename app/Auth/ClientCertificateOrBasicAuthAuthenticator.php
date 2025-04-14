<?php

namespace App\Auth;

class ClientCertificateOrBasicAuthAuthenticator
{
    private const SSL_CLIENT_VERIFY = "SSL_CLIENT_VERIFY";
    private const SSL_CLIENT_S_DN_CN = "SSL_CLIENT_S_DN_CN";
    private const BASIC_AUTH_USER_NAME = "BASIC_AUTH_USER_NAME";

    public static function getAuthenticatedUserName(): string|null
    {
        $ssl_auth_success = request()->server(self::SSL_CLIENT_VERIFY) === 'SUCCESS';
        $cn = request()->server(self::SSL_CLIENT_S_DN_CN);
        $basicAuthUserName = request()->server(self::BASIC_AUTH_USER_NAME);
        if ($ssl_auth_success) {
            return $cn;
        }

        return $basicAuthUserName;
    }

    public static function isAuthenticated(): bool
    {
        $user = self::getAuthenticatedUserName();
        return isset($user) && ($user !== '');
    }
}
