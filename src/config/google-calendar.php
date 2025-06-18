<?php

return [
    'default_auth_profile' => env('GOOGLE_CALENDAR_AUTH_PROFILE', 'oauth'),

    'auth_profiles' => [
        'service_account' => [
            'service_account_credentials_json' => storage_path('app/google-calendar/service-account.json'),
        ],
    ],
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),
];