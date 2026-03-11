# Issue Submission Form Connector

A Laravel package that provides a configurable issue submission form which creates issues in external providers like GitHub (with future GitLab support).

---

## Features

- 📋 Issue submission form
- ✅ Form validation with custom error messages
- 💾 Saves submissions to local database (two-table structure)
- 🐙 Creates issues in GitHub automatically
- 🔧 Fully configuration-driven
- 🎨 Publishable and overridable views
- 🔌 Provider abstraction for future GitLab support
- 📦 Auto-discovery support

---

## Requirements

- PHP 8.2+
- Laravel 12+
- MySQL

---

## Installation

Install the package via Composer:

```bash
composer require issueconnector/submission-form-connector
```

Laravel will auto-discover the package automatically.

---

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=submissionform
```

Add the following to your `.env` file:

```env
ISSUE_CONNECTOR_PROVIDER=github
GITHUB_TOKEN=your_github_token
GITHUB_REPO_OWNER=your_github_username
GITHUB_REPO_NAME=your_repo_name
GITHUB_API_URL=https://api.github.com
ISSUE_CONNECTOR_ROUTE=/submit-issue
ISSUE_CONNECTOR_STORAGE=true
ISSUE_CONNECTOR_QUEUE=false
```

---

## Database Setup

Run the migrations:

```bash
php artisan migrate
```

This will create two tables:

**`issue_submissions`** — stores core submission data:
- `id`
- `provider`
- `target_repository_or_project`
- `title`
- `body`
- `status`
- `timestamps`

**`issue_submission_meta`** — stores flexible key/value metadata:
- `id`
- `issue_submission_id`
- `meta_key`
- `meta_value`
- `timestamps`

---

## Usage

Visit the form route in your browser:

```
http://your-app.com/submit-issue
```

Fill in the form fields:
- **Issue Title** — required
- **Description** — required
- **Repository / Project** — optional
- **Labels** — optional
- **Your Name** — optional
- **Your Email** — optional

Submit the form and the issue will be created in GitHub automatically!

---

## Package Structure

```
submission-form-connector/
├── config/
│   └── issue-connector.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       └── form.blade.php
├── routes/
│   └── web.php
└── src/
    ├── Contracts/
    │   └── IssueProviderInterface.php
    ├── DTO/
    │   ├── IssueData.php
    │   └── SubmissionResult.php
    ├── Http/
    │   ├── Controllers/
    │   │   └── IssueFormController.php
    │   └── Requests/
    │       └── SubmitIssueRequest.php
    ├── Models/
    │   ├── IssueSubmission.php
    │   └── IssueSubmissionMeta.php
    ├── Services/
    │   ├── IssueProvider.php
    │   ├── IssueSubmissionService.php
    │   └── ProviderManager.php
    └── PackageServiceProvider.php
```

---

## Config Options

| Key | Description | Default |
|-----|-------------|---------|
| `provider` | Active provider | `github` |
| `github_token` | GitHub API token | `""` |
| `github_repo_owner` | GitHub repo owner | `""` |
| `github_repo_name` | GitHub repo name | `""` |
| `github_api_url` | GitHub API URL | `https://api.github.com` |
| `route_path` | Form route path | `/submit-issue` |
| `route_middleware` | Route middleware | `['web']` |
| `storage_enabled` | Enable DB storage | `true` |
| `queue_enabled` | Enable queue | `false` |

---

## Provider Abstraction

The package is designed to support multiple providers. Currently GitHub is supported. To add GitLab support in the future, implement the `IssueProviderInterface`:

```php
use IssueConnector\SubmissionFormConnector\Contracts\IssueProviderInterface;
use IssueConnector\SubmissionFormConnector\DTO\IssueData;
use IssueConnector\SubmissionFormConnector\DTO\SubmissionResult;

class GitLabProvider implements IssueProviderInterface
{
    public function createIssue(IssueData $issueData): SubmissionResult
    {
        // GitLab API implementation
    }
}
```

Then register it in `ProviderManager.php`:

```php
'gitlab' => new GitLabProvider(),
```

---

## Packagist

[https://packagist.org/packages/issueconnector/submission-form-connector](https://packagist.org/packages/issueconnector/submission-form-connector)

---

## License

MIT
