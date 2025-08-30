<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'], // porta do frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // já permite todos os headers
    'exposed_headers' => [], // opcional
    'max_age' => 0,
    'supports_credentials' => true, // se precisar enviar cookies
];