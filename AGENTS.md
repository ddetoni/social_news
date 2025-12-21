# Repository Guidelines

## Project Structure & Module Organization
- `src/` holds the PHP page controllers, templates (`header.php`, `footer.html`), CSS, and client JS.
- `api/` contains REST-style PHP endpoints and DB connection helpers.
- `tests/` contains Nightwatch functional tests in `tests/functional-tests/` and page objects in `tests/page-objects/`.
- `scripts/` includes DB lifecycle scripts and SQL under `scripts/sql/`.
- `images/` and `bd.jpeg` hold static assets used by the app.

## Build, Test, and Development Commands
- `composer install` installs PHP dependencies.
- `composer run-script setup-test` installs Nightwatch and Selenium.
- `composer start` (or `composer run-script start`) runs `heroku local` for local dev.
- `composer run-script create_db` creates the database schema.
- `composer run-script initial_data` loads seed data; `composer run-script refresh_db` resets and reloads.
- `composer test` refreshes the DB and runs Nightwatch; `nightwatch tests/functional-tests/notLoggedFlowTest.js` runs a single test.

## Coding Style & Naming Conventions
- PHP/HTML files in `src/` generally use tabs for indentation; keep existing style in the file you touch.
- JavaScript in `src/js/` uses 2-space indentation.
- Filenames are snake_case for PHP/HTML (e.g., `add_server_content.php`) and camelCase for JS (e.g., `registerValidation.js`).
- There is no enforced formatter or linter; keep changes consistent with nearby code.

## Testing Guidelines
- Nightwatch.js with Selenium is the primary test framework.
- Functional tests live in `tests/functional-tests/` and use `*Test.js` naming.
- Reuse or extend page objects in `tests/page-objects/` instead of hardcoding selectors.

## Commit & Pull Request Guidelines
- Recent commits use short, imperative subjects with occasional prefixes (e.g., `Migrate ...`, `ci: ...`).
- PRs should include a brief summary, testing notes (commands run), and UI screenshots when behavior changes.

## Architecture & Configuration Notes
- The codebase is migrating from direct MySQL queries to API calls in `api/`; follow that direction for new changes.
- Required environment variables: `CLEARDB_DATABASE_URL` and `API_BASE_URL`.
