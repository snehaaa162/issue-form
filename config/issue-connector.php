<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Active Provider
    |--------------------------------------------------------------------------
    | Supported: "github", "gitlab" (future)
    */
    'provider' => env('ISSUE_CONNECTOR_PROVIDER', 'github'),

    /*
    |--------------------------------------------------------------------------
    | GitHub Configuration
    |--------------------------------------------------------------------------
    */
    'github_token'      => env('GITHUB_TOKEN', ''),
    'github_repo_owner' => env('GITHUB_REPO_OWNER', ''),
    'github_repo_name'  => env('GITHUB_REPO_NAME', ''),
    'github_api_url'    => env('GITHUB_API_URL', 'https://api.github.com'),

    /*
    |--------------------------------------------------------------------------
    | Default Repository / Project
    |--------------------------------------------------------------------------
    */
    'default_repository' => env('GITHUB_REPO_OWNER', '') . '/' . env('GITHUB_REPO_NAME', ''),

    /*
    |--------------------------------------------------------------------------
    | Allowed Repositories / Projects
    |--------------------------------------------------------------------------
    */
    'allowed_repositories' => [
        env('GITHUB_REPO_OWNER', '') . '/' . env('GITHUB_REPO_NAME', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    */
    'route_path'       => env('ISSUE_CONNECTOR_ROUTE', '/submit-issue'),
    'route_middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Form Fields Configuration
    |--------------------------------------------------------------------------
    */
    'form_fields' => [
        'title'           => ['visible' => true,  'required' => true],
        'description'     => ['visible' => true,  'required' => true],
        'repository'      => ['visible' => true,  'required' => false],
        'labels'          => ['visible' => true,  'required' => false],
        'submitter_name'  => ['visible' => true,  'required' => false],
        'submitter_email' => ['visible' => true,  'required' => false],
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */
    'messages' => [
        'success' => 'Issue submitted and GitHub issue created successfully!',
        'failure' => 'Issue saved but failed to create on GitHub. Please try again.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    */
    'storage_enabled' => env('ISSUE_CONNECTOR_STORAGE', true),

    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    */
    'queue_enabled' => env('ISSUE_CONNECTOR_QUEUE', false),
];