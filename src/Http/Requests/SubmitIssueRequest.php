<?php

namespace IssueConnector\SubmissionFormConnector\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitIssueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'           => 'required|min:3',
            'description'     => 'required|min:5',
            'repository'      => 'nullable|string',
            'labels'          => 'nullable|string',
            'submitter_name'  => 'nullable|string',
            'submitter_email' => 'nullable|email',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Title is required.',
            'title.min'            => 'Title must be at least 3 characters.',
            'description.required' => 'Description is required.',
            'description.min'      => 'Description must be at least 5 characters.',
            'submitter_email.email'=> 'Please enter a valid email address.',
        ];
    }
}