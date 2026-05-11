# BiyaheMMSU - Tech Stack and Architecture Overview

## Overview
BiyaheMMSU is a Laravel-based web application designed for shuttle tracking and management, featuring role-based access for students, drivers, and administrators. The application integrates GPS tracking, driver approval workflows, and OAuth authentication.

## Tech Stack

### Backend
- **Language**: PHP 8.2+
- **Framework**: Laravel 12.0
- **Database**: 
  - Default: SQLite
  - Configured: MySQL
- **ORM**: Eloquent (Laravel's built-in ORM)
- **Authentication**: Laravel Breeze with custom extensions
- **OAuth Integration**: Laravel Socialite (Google OAuth)
- **Queue System**: Laravel Queues
- **Caching**: Laravel Cache
- **Sessions**: Laravel Sessions
- **Mail**: Laravel Mail
- **Logging**: Laravel Logging (Monolog)

### Frontend
- **Build Tool**: Vite 7.0.7
- **CSS Framework**: Tailwind CSS 3.1.0 with PostCSS
- **JavaScript Framework**: Vue.js 3.5.33
- **JavaScript Library**: Alpine.js 3.4.2
- **HTTP Client**: Axios 1.11.0
- **Styling Utilities**: @tailwindcss/forms plugin

### Development and Testing
- **Dependency Management**: Composer (PHP), npm (Node.js)
- **Testing Framework**: Pest 3.8 with Pest Plugin Laravel
- **Code Quality**: Laravel Pint
- **Development Server**: Laravel Sail (Docker-based)
- **Process Management**: Concurrently (for running multiple dev processes)

### Infrastructure
- **Web Server**: Built-in PHP server (development), configurable for production
- **File Storage**: Laravel Filesystem (local storage configured)
- **Environment Management**: .env files with Laravel's configuration system

## Frameworks and Libraries

### Core Frameworks
- **Laravel**: Full-stack PHP framework providing MVC architecture, routing, middleware, Eloquent ORM, migrations, seeders, and more.
- **Vue.js**: Progressive JavaScript framework for building user interfaces, used for dynamic frontend components.
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development.

### Key Libraries
- **Laravel Breeze**: Simple authentication starter kit with Blade templates and routes.
- **Laravel Socialite**: OAuth authentication provider for Google login.
- **Alpine.js**: Lightweight JavaScript framework for adding interactivity to HTML.
- **Axios**: Promise-based HTTP client for making API requests.
- **Pest**: PHP testing framework built on PHPUnit with a more expressive syntax.
- **Laravel Vite Plugin**: Integrates Vite build tool with Laravel for asset compilation.

## Integrations

### Authentication Integrations
- **Google OAuth**: Implemented via Laravel Socialite for seamless login using Google accounts.
- **Email Verification**: Built-in Laravel feature for user email verification.

### API Integrations
- **GPS Tracking API**: Custom API endpoint (`/api/shuttle-locations`) that returns real-time shuttle locations for drivers who are broadcasting.
- **Role-based Access Control**: Integrated throughout the application for different user types (admin, driver, student).

### External Services
- **Queue Processing**: Laravel's queue system for background job processing.
- **Caching Layer**: Configurable caching with multiple drivers (file, database, Redis, etc.).
- **Mail Service**: Configurable mail sending with multiple providers (SMTP, Mailgun, etc.).

## Middleware Integration and Employment

Laravel's middleware system is used extensively to control access, authenticate users, and manage application flow. Middleware acts as a bridge between requests and responses, allowing for preprocessing and postprocessing of HTTP requests.

### Built-in Laravel Middleware
- **Guest Middleware**: Protects routes from authenticated users (e.g., login/register pages).
- **Auth Middleware**: Ensures users are authenticated before accessing protected routes.
- **Throttle Middleware**: Rate limiting for routes like email verification.

### Custom Middleware

#### 1. CheckDriverStatus Middleware (`app/Http/Middleware/CheckDriverStatus.php`)
**Purpose**: Validates driver approval status and redirects accordingly.

**Integration**:
- Applied to routes requiring driver access.
- Checks if the authenticated user has the 'driver' role.
- Verifies approval status (`is_approved` field).
- Handles two rejection scenarios:
  - **Pending**: No admin comment, redirects to `auth.driver-pending` view.
  - **Rejected**: Admin comment present, redirects to `auth.driver-requirements` view for re-upload.

**Employment**:
- Ensures only approved drivers can access driver-specific features.
- Provides user-friendly feedback for pending or rejected driver applications.
- Integrated into the authentication flow via route middleware groups.

#### 2. RoleMiddleware (`app/Http/Middleware/RoleMiddleware.php`)
**Purpose**: Enforces role-based access control across the application.

**Integration**:
- Accepts a `$role` parameter to specify required role.
- Checks authentication status and redirects to appropriate login if not authenticated.
- Handles cross-role navigation:
  - Admins accessing non-admin routes are redirected to admin dashboard.
  - Non-admins accessing admin routes are redirected to student tracker.

**Employment**:
- Applied to admin routes to prevent unauthorized access.
- Ensures proper role segregation in the UI.
- Integrated with Laravel's route middleware system using the `middleware` method.

### Middleware Registration
Middleware is registered in `app/Http/Kernel.php` (or equivalent in Laravel 11+ via service providers). Custom middleware is typically registered with aliases for easy reference in routes.

### Route-Level Integration
Middleware is employed at the route level using:
- **Middleware Groups**: `Route::middleware(['auth', 'role:admin'])->group(...)`
- **Individual Routes**: `Route::get('/admin', ...)->middleware('role:admin')`
- **Controller Middleware**: Applied at the controller level for broader coverage.

### Integration with Authentication Flow
- Middleware works in conjunction with Laravel's authentication system.
- Custom middleware extends `Illuminate\Http\Middleware\Middleware` base class.
- Leverages Laravel's request lifecycle for pre and post-processing.

## Application Architecture

### MVC Pattern
- **Models**: `User`, `Shuttle` (Eloquent models)
- **Views**: Blade templates in `resources/views/`
- **Controllers**: Handle HTTP requests and responses

### Routing
- **Web Routes**: Public and authenticated routes in `routes/web.php`
- **Auth Routes**: Authentication-related routes in `routes/auth.php`
- **API Routes**: RESTful endpoints for data access

### Database Schema
- **Users Table**: Extended with role-based fields, approval status, GPS coordinates, and document paths.
- **Shuttles Table**: Basic shuttle information.
- **Migrations**: Version-controlled database schema changes.

### Security Features
- CSRF protection
- Input validation via Form Requests
- Password hashing
- Email verification
- Role-based access control

### Development Workflow
- **Setup**: `composer run setup` installs dependencies, generates keys, runs migrations, and builds assets.
- **Development**: `composer run dev` runs server, queue worker, logs, and Vite concurrently.
- **Testing**: `composer run test` executes Pest test suite.

This architecture provides a robust, scalable foundation for a shuttle tracking and management system with proper security, user management, and real-time features.