<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return response()->json([
      'version' => '1.0.0',
      'author' => 'Khudayberdiyev',
      'year' => '01.12.2025',
      'license' => 'MIT',
      'contact' => 'https://github.com/region-district-quarters',
      'repository' => 'https://github.com/region-district-quarters',
      'documentation' => config('scramble.api_domain') . '/docs/api',
      'message' => 'Welcome to the Region District Quarters API',
   ]);
});
