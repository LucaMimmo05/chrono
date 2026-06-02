# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# First-time setup
composer run setup

# Development (starts server, queue, log watcher, and Vite concurrently)
composer run dev

# Run all tests
composer run test

# Run a single test file
php artisan test tests/Feature/ProfileTest.php

# Run a single test by name
php artisan test --filter=test_name

# Lint / format with Pint
./vendor/bin/pint

# Migrations
php artisan migrate
php artisan migrate:fresh   # drop all tables and re-run (dev only)
```

## Architecture

**Stack:** Laravel 13 + Breeze (auth scaffolding) + Tailwind CSS v3 + Alpine.js + Vite. Database is **PostgreSQL via Supabase** in production/dev; tests run on SQLite in-memory.

**User roles:** `users.role` is an enum with values `collaborator` and `client` (default `collaborator`). `users.active` (boolean) controls whether the account is enabled.

**Domain models and their relationships:**
- `User` — two roles: `employer` creates projects, `collaborator` works on them
- `Project` — belongs to an employer (`users.id` via `employer_id`)
- `collaborator_project` pivot — links collaborators to projects with a `rate_type` (`hourly`/`fixed`) and `rate`; unique on `(collaborator_id, project_id)`
- `timesheet_entries` — a collaborator logs `hours` against a project on a given `date`
- `report_preferences` — per-user settings (e.g. `receive_email`)

**Routes (`routes/web.php`):** Auth routes live in `routes/auth.php` (Breeze). The `user` resource is under `Route::prefix('user')` inside the `auth` middleware group, mapping to `UserController` (index/store/show/update/destroy).

**Controllers return JSON** for the `user` resource. Blade views are used for auth, profile, and the dashboard.

**Models use PHP 8 attribute syntax** for `$fillable` / `$hidden` (e.g. `#[Fillable([...])]`) instead of class properties — this is intentional, not a bug.

**Testing:** PHPUnit 12. Tests use SQLite in-memory (`DB_DATABASE=:memory:`), so they are independent of the Supabase instance. The `pdo_pgsql` extension must be installed for the dev server to connect to Supabase (`sudo apt install php8.x-pgsql`); the CLI and the long-running `php artisan serve` process must both be started **after** the extension is installed.
