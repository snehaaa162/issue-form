<?php

namespace IssueConnector\SubmissionFormConnector\DTO;

class IssueData
{
    public function __construct(
        public string $title,
        public string $body,
        public string $target,
        public ?string $labels = null,
        public ?string $submitterName = null,
        public ?string $submitterEmail = null,
    ) {}
}