<?php

namespace App\Http\Middleware;

use App\Auth\ClientCertificateOrBasicAuthAuthenticator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecretaryOnlyAccess
{
    /**
     * Проверим, что мы имеем доступ секретаря
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!ClientCertificateOrBasicAuthAuthenticator::isAuthenticated()) {
            return \response()->view("errors.forbidden")->setStatusCode(403);
        }

        return $next($request);
    }
}
