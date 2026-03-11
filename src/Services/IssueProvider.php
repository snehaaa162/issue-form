<?php

namespace IssueConnector\SubmissionFormConnector\Services;

use IssueConnector\SubmissionFormConnector\Contracts\IssueProviderInterface;
use IssueConnector\SubmissionFormConnector\DTO\IssueData;
use IssueConnector\SubmissionFormConnector\DTO\SubmissionResult;
use Illuminate\Support\Facades\Http;

class IssueProvider implements IssueProviderInterface
{
    public function createIssue(IssueData $issueData): SubmissionResult
    {
        $response = Http::withToken(config('issue-connector.github_token'))
            ->post(
                'https://api.github.com/repos/'
                . config('issue-connector.github_repo_owner') . '/'
                . config('issue-connector.github_repo_name') . '/issues',
                [
                    'title' => $issueData->title,
                    'body'  => $issueData->body . "\n\n---\n**Submitted by:** " 
                            . ($issueData->submitterName ?? 'Anonymous') 
                            . "\n**Email:** " 
                            . ($issueData->submitterEmail ?? 'Not provided')
                            . "\n**Labels:** "
                            . ($issueData->labels ?? 'None'),
                ]
            );

        if ($response->successful()) {
            return new SubmissionResult(
                success: true,
                issueNumber: $response->json('number'),
                issueUrl: $response->json('html_url'),
            );
        }

        return new SubmissionResult(
            success: false,
            errorMessage: $response->body(),
        );
    }
}