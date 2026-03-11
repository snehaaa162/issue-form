<?php

namespace IssueConnector\SubmissionFormConnector\DTO;

class SubmissionResult
{
    public function __construct(
        public bool $success,
        public ?int $issueNumber = null,
        public ?string $issueUrl = null,
        public ?string $errorMessage = null,
    ) {}
}