<?php

namespace IssueConnector\SubmissionFormConnector\Contracts;

use IssueConnector\SubmissionFormConnector\DTO\IssueData;
use IssueConnector\SubmissionFormConnector\DTO\SubmissionResult;

interface IssueProviderInterface
{
    public function createIssue(IssueData $issueData): SubmissionResult;
}