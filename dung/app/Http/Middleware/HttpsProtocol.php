<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    public function handle(Request $request, Closure $next) {
      if (!$request->secure()) //http면
      {
        return redirect()->secure($request->getRequestUri());
      }
      else { // 아니면
        return $next($request); // 그대로
      }
    }
  }
