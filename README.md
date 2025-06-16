# MyKICT Smart Study Planner

MyKICT is a Laravel-based web application developed for the International Islamic University Malaysia (IIUM) to streamline academic planning and course allocation for students and administrators. It automatiacally suggests students’ next semester course selection, helps them to create study plan, provides semester-wise GPA and CGPA tracking, supports role-based dashboards for both students and admins, and offers statistics on total students to help determine the number of course sections to open. Incorporating secure multi-factor authentication and built with a responsive Bootstrap interface alongside Laravel Fortify, MyKICT enhances academic management and delivers a smooth user experience.

---

## Table of Contents

- [Features](#features)  
- [Technology Stack & Tools](#technology-stack--tools)
- [Development Environment & Tools](#development-environment--tools)
- [Installation](#installation)  
- [Configuration](#configuration)  
- [Database Schema Overview](#database-schema-overview)  
- [Authentication & Security](#authentication--security)  
- [Testing](#testing)  
- [Contributing](#contributing)  
- [License](#license)

---

## Features

### Student Features
- Student dashboard showing profile details, upcoming semester summary and courses details, and GPA and CGPA progress chart.  
- Profile update and management.
- View suggested courses based on their programme, year and semester (automatically calculating semester and year rollover)
- Track CGPA and GPA progress through a chart.
- Use a calculation and forecasting tool to project academic performance.
- Chat with AI-powered academic advisor in chatbot.

### Administrator Features
- Admin dashboard with summary reports (graphs of student enrollment for each course, department and specialization).
- Manage courses: add, edit, delete courses with detailed metadata including pre-requisites, specialization, and category.  
- Bulk deletion of multiple courses.
- Filter courses by department, specialization, category, programme and year.
- Search courses by course code and course title.
- Sort courses by each column.

### UI & UX
- Responsive design leveraging Bootstrap 5 and Google Fonts (Poppins).  
- DataTables for advanced table interaction on admin pages.  
- Interactive charts using ApexCharts, C3, and D3.  
- Simple Calendar plugin for schedule visualizations.  
- Theme toggle supporting light and dark modes.

---

## Technology Stack & Tools

- **Backend:** PHP 8.2, Laravel 11.x  
- **Frontend:** Blade templates, Bootstrap 5, jQuery  
- **Database:** MySQL, phpMyAdmin
- **Authentication:** Laravel Fortify, Argon2id (via Laravel’s native hashing),  email OTP 2FA  
- **Task Automation:** Laravel Artisan, npm scripts with Vite  
- **Charts & Visualization:** ApexCharts, C3.js, D3.js  
- **Icons & Fonts:** Font Awesome 5.15.4, Bootstrap Icons, Google Fonts (Poppins)
- **AI for Chatbot:** Zapier

## Development Environment & Tools

- **Local Server Stack:** XAMPP (Local Apache, PHP, and MySQL server stack)
- **Code Editor:** Visual Studio Code (VSCode) 

---

## Installation

```bash
# Clone the repo
git clone [https://github.com/<your-username>/mykict.git](https://github.com/mkazmiiium/mykict.git)
cd mykict
git checkout mykict_student

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
```

By default, the application will be accessible at `http://localhost:8000` or `http://127.0.0.1:8000`.

---

## Configuration

Edit your `.env` file for environment-specific settings such as:

* Use `php artisan key:generate` to generate a valid `APP_KEY`.
* Update database credentials: `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
* Update mail credentials for email OTP functionality.
* Session and cache driver settings (default uses database and file)

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:your-app-key-generated-by-laravel
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mykict
DB_USERNAME=mykict_user
DB_PASSWORD=mykict_user20242025

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-email-password-or-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

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
> Each user belongs to one role (admin, student).

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

- The schema uses bigint unsigned primary keys for users and admins to ensure scalability.  
- `students.matric_no` is an integer primary key rather than an auto-increment ID.  
- GPA is stored per semester to allow detailed academic tracking.  
- Passwords are stored hashed in the `users` and `admins` tables.

---

## Authentication & Security

* Passwords are hashed automatically using Laravel’s built-in Argon2id algorithm via the native `hashed` attribute casting on the User model.  
* There is no manual salting applied to passwords; Laravel handles all salting internally and securely.  
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
