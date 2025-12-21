# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Social News is a social platform web application for creating and sharing news articles. This is a college project from 2012 undergoing major refactoring to modernize the codebase.

**Current Architecture State**: Transitioning from legacy procedural PHP monolith to API-driven architecture.

## Technology Stack

- **Backend**: PHP 7.4, Apache
- **Database**: MySQL with ClearDB on Heroku
- **API Client**: Resty library for HTTP calls
- **Frontend**: HTML/CSS with jQuery 1.5.1
- **Testing**: Nightwatch.js with Selenium WebDriver
- **Deployment**: Docker, Heroku

## Development Commands

### Setup
```bash
composer install                    # Install PHP dependencies
composer run-script setup-test      # Install Nightwatch and Selenium
```

### Running the Application
```bash
npm start                          # Start development server
# OR
heroku local                       # Alternative using Heroku toolbelt
```

### Database Management
```bash
composer run-script create_db      # Create database schema
composer run-script initial_data   # Load initial test data
composer run-script refresh_db     # Clean and reload database
composer run-script cleanup_db     # Remove all data
```

### Testing
```bash
composer test                      # Refresh database and run all tests
nightwatch                         # Run tests (assumes DB is ready)
nightwatch tests/functional-tests/specific-test.js  # Run single test
```

## High-Level Architecture

### Hybrid Architecture Pattern

The codebase is in transition between two architectural approaches:

**Legacy Approach** (being phased out):
- Direct database queries using deprecated `mysql_*` functions
- Procedural PHP with inline SQL
- File organization: `/src/*.php` (page controllers with embedded logic)

**Modern Approach** (target state):
- RESTful API calls using Resty HTTP client
- Separation of concerns with `/api` endpoints
- Files migrated: `login.php`, `register.php`, `content.php`

### Component Structure

**Frontend Layer** (`/src/`):
- `index.php` - Main entry point, loads composer autoloader and orchestrates template includes
- `header.php`, `content.php`, `footer.html` - Template components
- Page controllers: `news.php`, `login.php`, `register.php`, `panel.php`, etc.
- `/js` - Client-side validation and AJAX interactions
- `/styles` - CSS styling

**API Layer** (`/api/`):
- `news.php` - RESTful endpoint for news retrieval with tag-based filtering
- `dbconnect.php` - Database connection configuration using environment variables
- API responses in JSON format with `result`, `data`, `server_name`, `reason`, `code` fields

**Data Layer**:
- MySQL database with 6 tables: Users, News, Comments, Favorites, Servers, PasswordChange
- Foreign keys with CASCADE for data integrity
- SHA1 password hashing (security concern - should migrate to bcrypt/argon2)

**Comments Module** (`/comments/`):
- Dedicated PHP files for CRUD operations: `add_comment.php`, `edit_comment.php`, `remove_comment.php`

### Database Schema

Core tables:
- **users**: User accounts with role-based permissions (1=user, 2=editor, 3=admin)
- **news**: Articles with title, text, tags (space-separated), date, url
- **comments**: User comments on news articles
- **favorites**: User-saved news items

### Authentication

- Session-based using `$_SESSION` variables
- Stores: username, validation flag, permissionLevel, idUser
- Role-based access control with 3 permission levels

### Environment Configuration

Required environment variables:
- `CLEARDB_DATABASE_URL` - Database connection string
- `API_BASE_URL` - Base URL for API calls

## Migration Strategy

When modifying existing code, follow the established pattern of migrating to API calls:

1. Identify direct database queries in page controllers
2. Create or use existing API endpoints in `/api`
3. Replace `mysql_query()` calls with Resty HTTP client calls
4. Maintain backward compatibility during transition

Example pattern from `login.php`:
```php
$resty = new Resty\Resty();
$result = $resty->get("users", "filter[where][username]=$username");
```

## File Locations

- **Main entry point**: `/src/index.php`
- **Database schema**: `/scripts/sql/create_db.sql`
- **API endpoints**: `/api/*.php`
- **Page controllers**: `/src/*.php`
- **Tests**: `/tests/functional-tests/*.js`
- **Page objects**: `/tests/page-objects/*.js`
- **Configuration**: Environment variables in Dockerfile and `.user.ini`

## Important Notes

- Files are organized by feature, not strict MVC pattern
- Some files still use deprecated `mysql_*` functions - these should be migrated to API calls
- Tags are stored as space-separated strings in single text column (not normalized)
- Password hashing uses SHA1 (weak by modern standards)
