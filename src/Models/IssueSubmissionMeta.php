<?php

namespace IssueConnector\SubmissionFormConnector\Models;

use Illuminate\Database\Eloquent\Model;

class IssueSubmissionMeta extends Model
{
    protected $table = 'issue_submission_meta';

    protected $fillable = [
        'issue_submission_id',
        'meta_key',
        'meta_value',
    ];

    public function submission()
    {
        return $this->belongsTo(IssueSubmission::class, 'issue_submission_id');
    }
}