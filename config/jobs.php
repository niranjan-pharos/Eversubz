<?php
return [
    'payment_types' => [
        'per_month' => 'Per Month',
        'per_hour' => 'Per Hour',
        'weekly' => 'Weekly',
        'project' => 'Project Basis',
    ],

    'experience_levels' => [
        'beginner' => 'Beginner',
        'intermediate' => 'Intermediate',
        'expert' => 'Expert',
    ],

    'job_modes' => [
        'full_time' => 'Full-Time',
        'part_time' => 'Part-Time',
        'remote' => 'Remote',
        'internship' => 'Internship',
        'contract' => 'Contract Base',
        'freelance' => 'Freelance',
    ],
    'job_expiry_days' => env('JOB_EXPIRY_DAYS', 30),
];
