<?php

namespace IssueConnector\SubmissionFormConnector\Services;

use IssueConnector\SubmissionFormConnector\Contracts\IssueProviderInterface;
use IssueConnector\SubmissionFormConnector\Services\IssueProvider;

class ProviderManager
{
    public function driver(?string $provider = null): IssueProviderInterface
    {
        $provider = $provider ?? config('issue-connector.provider', 'github');

        return match($provider) {
            'github' => new IssueProvider(),
            default  => throw new \InvalidArgumentException("Unsupported provider: {$provider}"),
        };
    }
}