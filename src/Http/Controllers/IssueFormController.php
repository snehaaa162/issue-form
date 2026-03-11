<?php

namespace IssueConnector\SubmissionFormConnector\Http\Controllers;

use Illuminate\Routing\Controller;
use IssueConnector\SubmissionFormConnector\Http\Requests\SubmitIssueRequest;
use IssueConnector\SubmissionFormConnector\Models\IssueSubmission;
use IssueConnector\SubmissionFormConnector\Services\IssueSubmissionService;

class IssueFormController extends Controller
{
    protected $service;

    public function __construct(IssueSubmissionService $service)
    {
        $this->service = $service;
    }

    // Show the form
    public function showForm()
    {
        return view('submissionform::form');
    }

    // Handle form submission
    public function submitForm(SubmitIssueRequest $request)
    {
        $data = $request->validated();

        $this->service->submitIssue($data);

        return redirect()->back()->with('success', 'Issue submitted and GitHub issue created!');
    }
}