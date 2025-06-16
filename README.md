# MyKICT Smart Study Planner

**MyKICT** is a web application developed using Laravel to assist students and administrators at IIUM in efficiently planning study programs and course allocations each semester. It automates prerequisite validation, enforces credit hour limits, and provides clean, role-based dashboards.

---

## Table of Contents

- [Features](#features)  
- [Technology Stack](#technology-stack)  
- [Installation](#installation)  
- [Configuration](#configuration)  
- [Usage](#usage)  
- [Database Schema](#database-schema)  
- [Authentication & Security](#authentication--security)  
- [Testing](#testing)  
- [Contributing](#contributing)  
- [License](#license)

---

## Features

### Student Features
- View dashboard showing current academic year, semester, and GPA summary.  
- Generate study plans for the next semester, automatically calculating semester and year rollover.  
- Enforces prerequisite checks before allowing course selection.  
- Validates credit hour limits per semester to avoid under/overloading.  
- Filter courses by department, specialization, category, and semester.  
- Profile update and management.

### Administrator Features
- Manage courses: add, edit, delete courses with detailed metadata including pre-requisites, specialization, and category.  
- Bulk deletion of multiple courses.  
- Manage departments and specializations.  
- View security and activity logs.  
- Admin dashboard with summary reports.

### Security & Authentication
- Laravel Fortify integration with email-based OTP two-factor authentication (2FA).  
- Passwords hashed using Argon2id with an additional per-user manual salt for enhanced security.  
- Login attempts rate limiting to prevent brute force attacks.  
- Session management and CSRF protection out of the box with Laravel.

### UI & UX
- Responsive design leveraging Bootstrap 5 and Google Fonts (Poppins).  
- DataTables for advanced table interaction on admin pages.  
- Interactive charts using ApexCharts, C3, and D3.  
- Simple Calendar plugin for schedule visualizations.  
- Theme toggle supporting light and dark modes.

---

## Technology Stack

- **Backend:** PHP 8.2, Laravel 11.x  
- **Frontend:** Blade templates, Bootstrap 5, jQuery  
- **Database:** MySQL  
- **Authentication:** Laravel Fortify, Argon2id, manual password salting, email OTP 2FA  
- **Task Automation:** Laravel Artisan, npm scripts with Vite  
- **Charts & Visualization:** ApexCharts, C3.js, D3.js  
- **Icons & Fonts:** Font Awesome 5.15.4, Bootstrap Icons, Google Fonts (Poppins)

---

## Installation

```bash
# Clone the repo
git clone https://github.com/<your-username>/mykict.git
cd mykict

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Compile frontend assets
npm run dev

# Copy environment example and generate app key
cp .env.example .env
php artisan key:generate

# Configure your database in .env

# Run migrations and seed the database
php artisan migrate --seed

# Serve the application
php artisan serve

By default, the application will be accessible at `http://localhost:8000`.

---

## Configuration

Edit your `.env` file for environment-specific settings such as:

* `APP_URL` (base URL of your app)
* Database credentials: `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
* Mail server for OTP emails: `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`
* Session and cache driver settings (default uses database and file)

---

## Usage

* Register as a new user or login (admin accounts should be seeded or created manually).
* Students can generate and manage their study plans, view CGPA, and update profiles.
* Admins can manage courses, departments, specializations, and monitor logs.
* Use the theme toggle in the navbar to switch between light and dark mode.

---

## Database Schema Overview

### Key Tables and Relationships

#### `users`
- `id` (bigint, primary key)
- `name` (varchar 255)
- `email` (varchar 255, unique)
- `email_verified_at` (timestamp, nullable)
- `password` (varchar 255, hashed)
- `role_id` (bigint unsigned, foreign key to `roles.id`)
- `two_factor_secret` (text, nullable)
- `two_factor_recovery_codes` (text, nullable)
- `two_factor_confirmed_at` (timestamp, nullable)
- `remember_token` (varchar 100, nullable)
- `profile_photo_path` (varchar 2048, nullable)
- `two_factor_code` (varchar 255, nullable)
- `two_factor_expires_at` (timestamp, nullable)
- Timestamps (`created_at`, `updated_at`)

#### `roles`
- `id` (bigint, primary key)
- `name` (varchar 255)
- Timestamps

> **Relationship:**  
> Each user belongs to one role (e.g., admin, student).

---

#### `admins`
- `admin_id` (bigint, primary key)
- `ad_name` (varchar 255)
- `ad_email` (varchar 255)
- `ad_password` (varchar 255)
- `user_id` (bigint unsigned, foreign key to `users.id`)
- Timestamps

> **Relationship:**  
> One-to-one link between `admins` and `users`.

---

#### `students`
- `matric_no` (int, primary key)
- `st_name` (varchar 255)
- `st_email` (varchar 255)
- `st_password` (varchar 255)
- `year` (int)
- `sem` (int)
- `programme` (varchar 255)
- `current_cgpa` (decimal 4,2)
- `user_id` (bigint unsigned, foreign key to `users.id`)
- `specialization` (varchar 255)
- GPA and CGPA columns per semester (gpa_sem1 … gpa_sem8, cgpa_sem1 … cgpa_sem8) decimal(4,2)
- Timestamps

> **Relationship:**  
> One-to-one link between `students` and `users`.

---

#### `courses`
- `course_code` (varchar 255, primary key)
- `course_title` (varchar 255)
- `credit_hrs` (int)
- `department` (varchar 255)
- `pre_requisites` (varchar 255, nullable)
- `year` (int)
- `sem` (int)
- `specialization` (varchar 255, nullable)
- `category` (varchar 255, nullable)
- `programme` (varchar 255, nullable)
- Timestamps

---

#### `student_preferences`
- `preference_id` (bigint, primary key)
- `matric_no` (int, foreign key to `students.matric_no`)
- `course_code` (varchar 255, foreign key to `courses.course_code`)
- `status` (enum: 'add', 'drop')
- `course_title` (varchar 255)
- `credit_hrs` (int)
- Timestamps

> **Relationship:**  
> Student preferences link students and courses with an add/drop status.

---

### Summary of Key Relationships

- `users.role_id` → `roles.id` (many users belong to one role)  
- `admins.user_id` → `users.id` (one admin belongs to one user)  
- `students.user_id` → `users.id` (one student belongs to one user)  
- `student_preferences.matric_no` → `students.matric_no` (student preference linked to student)  
- `student_preferences.course_code` → `courses.course_code` (student preference linked to course)

---

### Notes

- The schema uses **bigint unsigned** primary keys for users and admins to ensure scalability.  
- `students.matric_no` is an integer primary key rather than an auto-increment ID.  
- GPA is stored per semester to allow detailed academic tracking.  
- Passwords are stored hashed in the `users` and `admins` tables.

---

## Authentication & Security

* Passwords are hashed automatically using Laravel’s built-in Argon2id algorithm via the native `hashed` attribute casting on the User model.  
* There is **no manual salting** applied to passwords; Laravel handles all salting internally and securely.  
* Laravel Fortify is used to manage registration, login, password resets, and two-factor authentication (2FA) via email OTP codes.  
* Uses Laravel's default `web` guard with session driver and Eloquent user provider (`App\Models\User`).  
* Password resets utilize a custom tokens table (`password_reset_tokens`) with standard expiry (60 minutes) and throttle (60 seconds).  
* Rate limiting is enabled on login attempts to protect against brute-force attacks.  
* Session management and CSRF protections are enforced by Laravel out of the box.  
* Two-factor authentication is implemented using Laravel Fortify’s `TwoFactorAuthenticatable` trait and custom mailables for OTP email delivery.

---

## Testing

Run tests with:

```bash
php artisan test
```

Ensure you have a testing database configured and migrations run in the test environment.

---

## Contributing

Contributions are welcome! Please:

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add feature'`).
4. Push to your branch (`git push origin feature-name`).
5. Open a pull request.

Follow PSR-12 coding standards and add tests where applicable.

---

## License

This project is licensed under the [MIT License](LICENSE).

---
