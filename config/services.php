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

    'adviser' => [
        'types' => ['Adviser', 'Staff', 'Management'],
        'status' => ['Active', 'Pending', 'Terminated'],
        'requirements' => [
            'sub-agencies' => [
                'fidelity-life' => [
                    'label' => 'Fidelity Life',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'accuro' => [
                    'label' => 'Accuro',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'aia' => [
                    'label' => 'AIA',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'partners-life' => [
                    'label' => 'Partners Life',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'nib' => [
                    'label' => 'NIB',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'cigna' => [
                    'label' => 'Cigna',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
                'kiwisaver' => [
                    'label' => 'Kiwisaver',
                    'options' => ['Active', 'Pending', 'Declined', 'No Application'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Pending' => 'text-green-600',
                        'Declined' => 'text-red-600',
                        'No Application' => 'text-red-600',
                    ],
                ],
            ],
            'adviser-requirements' => [
                'fspr' => [
                    'label' => 'FSPR',
                    'options' => 'expiring-date',
                ],
                'drs' => [
                    'label' => 'DRS',
                    'options' => ['Paid', 'Partial', 'Not Paid', 'Others'],
                    'classes' => [
                        'Paid' => 'text-shark',
                        'Partial' => 'text-green-600',
                        'Not Paid' => 'text-red-600',
                        'Others' => 'text-shark',
                    ],
                ],
                'pi-cover' => [
                    'label' => 'PI Cover',
                    'options' => ['Paid', 'Partial', 'Not Paid', 'Agreement'],
                    'classes' => [
                        'Paid' => 'text-shark',
                        'Partial' => 'text-green-600',
                        'Not Paid' => 'text-red-600',
                        'Agreement' => 'text-shark',
                    ],
                ],
                'lvl-5' => [
                    'label' => 'Level 5',
                    'options' => ['Finished', 'Ongoing', 'Not Enrolled'],
                    'classes' => [
                        'Finished' => 'text-shark',
                        'Ongoing' => 'text-green-600',
                        'Not Enrolled' => 'text-red-600',
                    ],
                ],
            ],
            'documentary-requirements' => [
                'bank-acct-aml' => [
                    'label' => 'Bank Acct (AML)',
                    'options' => ['Compliant', 'Non-Compliant'],
                    'classes' => [
                        'Compliant' => 'text-shark',
                        'Non-Compliant' => 'text-red-600',
                    ],
                ],
                'tax' => [
                    'label' => 'Tax',
                    'options' => ['GST', 'Non-GST', 'WHT', 'Pending'],
                    'classes' => [
                        'GST' => 'text-shark',
                        'Non-GST' => 'text-shark',
                        'WHT' => 'text-shark',
                        'Pending' => 'text-red-600',
                    ],
                ],
                'business-photo' => [
                    'label' => 'Business Photo',
                    'options' => ['Received', 'Not Received'],
                    'classes' => [
                        'Received' => 'text-shark',
                        'Not Received' => 'text-red-500',
                    ],
                ],
                'id' => [
                    'label' => 'ID',
                    'options' => ['Received', 'Not Received'],
                    'classes' => [
                        'Received' => 'text-shark',
                        'Not Received' => 'text-red-500',
                    ],
                ],
            ],
            'software' => [
                'email' => [
                    'label' => 'Email',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
                'pipedrive' => [
                    'label' => 'Pipedrive',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
                'training' => [
                    'label' => 'Training',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
                'advice-process' => [
                    'label' => 'Advice Process',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
                'website' => [
                    'label' => 'Website',
                    'options' => ['Yes', 'No'],
                    'classes' => [
                        'Yes' => 'text-shark',
                        'No' => 'text-red-600',
                    ],
                ],
                'client-feedback-report' => [
                    'label' => 'Client Feedback Report',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
                'lead-tracker' => [
                    'label' => 'Lead Tracker',
                    'options' => ['Active', 'Not Active'],
                    'classes' => [
                        'Active' => 'text-shark',
                        'Not Active' => 'text-red-600',
                    ],
                ],
            ],
        ],
    ],

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
                'status' => [
                    'Pending',
                    'Resolved',
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
                'status' => [
                    'Pending',
                    'Resolved',
                    'Failed',
                    'Retracted',
                    'Invalid',
                    'Deadlock',
                ],
            ],
        ],

    ],

    'claim' => [
        'natures' => [
            'Pre-approval',
            'Claim',
        ],
        'types' => [
            'Life',
            'Trauma',
            'Medical',
            'TPD',
            'IP',
        ],
        'status' => [
            'In Progress', 'Continuing', 'Disapproved', 'Approved', 'Partially Approved',
        ],
    ],

    'cir' => [
        'url' => env('CIR_URL'),
    ],

    'site' => [
        'manual' => [
            'mimes' => ['txt', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'mp4', 'mov', 'avi', 'wmv', 'mkv'],
            'mimetypes' => [
                'text/plain',
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'video/mp4',
                'video/quicktime',
                'video/x-msvideo',
                'video/x-ms-wmv',
                'video/x-matroska',
            ],
        ],
    ],

    'file' => [
        'icons' => [
            'txt' => 'forkawesome-file-text-o',
            'pdf' => 'forkawesome-file-pdf-o',
            'doc' => 'forkawesome-file-word-o',
            'docx' => 'forkawesome-file-word-o',
            'ppt' => 'forkawesome-file-powerpoint-o',
            'pptx' => 'forkawesome-file-powerpoint-o',
            'mp4' => 'forkawesome-file-video-o',
            'mov' => 'forkawesome-file-video-o',
            'avi' => 'forkawesome-file-video-o',
            'wmv' => 'forkawesome-file-video-o',
            'mkv' => 'forkawesome-file-video-o',
        ],
    ],

];
