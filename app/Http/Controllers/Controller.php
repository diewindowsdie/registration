<?php

namespace App\Http\Controllers;

abstract class Controller
{
    const SSL_CLIENT_VERIFY = "SSL_CLIENT_VERIFY";
    const SSL_CLIENT_S_DN_CN = "SSL_CLIENT_S_DN_CN";
    const BASIC_AUTH_USER_NAME = "BASIC_AUTH_USER_NAME";

    public function getAuthenticatedUserName() {
        $ssl_auth_success = request()->server(self::SSL_CLIENT_VERIFY) === 'SUCCESS';
        $cn = request()->server(self::SSL_CLIENT_S_DN_CN);
        $basicAuthUserName = request()->server(self::BASIC_AUTH_USER_NAME);
        if ($ssl_auth_success) {
            return $cn;
        }

        return $basicAuthUserName;
    }
}
