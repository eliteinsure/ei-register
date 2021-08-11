<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'company' => [
        'url' => env('COMPANY_URL', 'https://eliteinsure.co.nz'),
        'web' => env('COMPANY_WEB', 'www.eliteinsure.co.nz'),
    ],

    'roles' => ['admin', 'user'],

    'complaint' => [
        'labels' => [
            'Client',
            'Prospect',
            'Adviser',
            'Business Partner',
            'Employee',
            'Contractor',
            'Government',
            'External Broker',
            'N/A',
            'Others',
        ],
        'insurers' => [
            'AIA',
            'Fidelity Life',
            'Partners Life',
            'CIGNA',
            'Accuro',
            'NZFunds',
            'N/A',
        ],
        'natures' => [
            'Service (Adviser)',
            'Service (Admin)',
            'Service (Marketer)',
            'Service (Management)',
            'Contract',
            'Conduct',
        ],
        'tier' => [
            '1' => [
                'results' => [
                    'Success',
                    'Failed',
                    'Retracted',
                    'Invalid',
                ],
            ],
            '2' => [
                'staffPositions' => [
                    'Managing Director',
                    'Executive Admin',
                    'Relationship Manager',
                    'Admin ADR',
                    'SADR',
                ],
                'results' => [
                    'Success',
                    'Failed',
                    'Retracted',
                    'Invalid',
                    'Deadlock',
                ],
            ],
        ],

    ],

];
