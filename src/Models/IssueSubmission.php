<?php

namespace IssueConnector\SubmissionFormConnector\Models;

use Illuminate\Database\Eloquent\Model;

class IssueSubmission extends Model
{
    protected $table = 'issue_submissions';

    protected $fillable = [
        'provider',
        'target_repository_or_project',
        'title',
        'body',
        'status',
    ];

    public function meta()
    {
        return $this->hasMany(IssueSubmissionMeta::class, 'issue_submission_id');
    }
}