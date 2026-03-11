<?php

namespace IssueConnector\SubmissionFormConnector\Services;

use IssueConnector\SubmissionFormConnector\DTO\IssueData;
use IssueConnector\SubmissionFormConnector\Models\IssueSubmission;
use IssueConnector\SubmissionFormConnector\Models\IssueSubmissionMeta;

class IssueSubmissionService
{
    public function __construct(
        protected ProviderManager $providerManager
    ) {}

    public function submitIssue(array $data): void
    {
        // Save main submission to database
        $submission = IssueSubmission::create([
            'provider'                     => config('issue-connector.provider', 'github'),
            'target_repository_or_project' => config('issue-connector.github_repo_owner') . '/' . config('issue-connector.github_repo_name'),
            'title'                        => $data['title'],
            'body'                         => $data['description'],
            'status'                       => 'open',
        ]);

        // Build IssueData DTO
        $issueData = new IssueData(
            title: $data['title'],
            body: $data['description'],
            target: config('issue-connector.github_repo_owner') . '/' . config('issue-connector.github_repo_name'),
            labels: $data['labels'] ?? null,
            submitterName: $data['submitter_name'] ?? null,
            submitterEmail: $data['submitter_email'] ?? null,
        );

        // Use ProviderManager to create issue
        $result = $this->providerManager->driver()->createIssue($issueData);

        // Save meta data
        IssueSubmissionMeta::create([
            'issue_submission_id' => $submission->id,
            'meta_key'            => 'github_issue_number',
            'meta_value'          => $result->issueNumber,
        ]);

        IssueSubmissionMeta::create([
            'issue_submission_id' => $submission->id,
            'meta_key'            => 'github_issue_url',
            'meta_value'          => $result->issueUrl,
        ]);

        IssueSubmissionMeta::create([
            'issue_submission_id' => $submission->id,
            'meta_key'            => 'success',
            'meta_value'          => $result->success ? 'true' : 'false',
        ]);

        // Update status if failed
        if (!$result->success) {
            $submission->update(['status' => 'failed']);

            IssueSubmissionMeta::create([
                'issue_submission_id' => $submission->id,
                'meta_key'            => 'error_message',
                'meta_value'          => $result->errorMessage,
            ]);
        }
    }
}