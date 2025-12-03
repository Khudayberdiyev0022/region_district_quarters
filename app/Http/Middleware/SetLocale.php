<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
  public function handle(Request $request, Closure $next)
  {
    $locale = strtolower(explode('-', $request->header('Accept-Language', 'uz'))[0]);
    $locale = in_array($locale, ['uz', 'oz', 'ru']) ? $locale : 'uz';

    app()->setLocale($locale);

    return $next($request);
  }
}
