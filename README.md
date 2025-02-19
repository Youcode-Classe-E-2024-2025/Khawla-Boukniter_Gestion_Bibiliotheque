# Library Management System

A modern web application for managing library resources, built with Laravel and Tailwind CSS.

## Features

### User Management
- Role-based authentication (Admin/User)
- User registration and login
- Personal dashboard for users
- Profile management

### Book Management
- Complete CRUD operations for books
- Book inventory tracking
- Search functionality
- Availability status

### Borrowing System
- Book borrowing process
- Return management
- Borrowing history
- Due date tracking
- Status indicators (In Progress, Returned, Overdue)

### Admin Dashboard
- Global statistics
- Recent activities monitoring
- User management
- Book inventory oversight
- Borrowing management

## Technical Stack

### Backend
- Laravel Framework
- PostgreSQL Database
- Eloquent ORM
- Authentication System

### Frontend
- Tailwind CSS
- Blade Templates
- Responsive Design
- Modern UI Components

## Database Structure

### Tables
- users
- books
- borrowings

### Key Relationships
- User -> Borrowings (One to Many)
- Book -> Borrowings (One to Many)

## Installation

1. Clone the repository
```bash
git clone https://github.com/Youcode-Classe-E-2024-2025/Khawla-Boukniter_Gestion_Bibiliotheque.git
```	

2. Install dependencies
```bash
composer install
npm install
```

3. Configure environment variables
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database

```bash
php artisan migrate
```

5. Start the development server
```bash
php artisan serve
npm run dev
```

## Usage
* Admin Access
- Manage books inventory
- Monitor borrowing activities
- View statistics

* User Access
- Search for books
- Borrow books
- Browse available books
- View borrowing history

## Project Structure
- `app/Http/Controllers/`: Controllers for handling HTTP requests
- `app/Models/`: Eloquent models for database tables
- `resources/views/`: Blade templates for views
- `public/`: Static assets (CSS, JS, images)
- `routes/`: Web routes
- `database/migrations/`: Database migrations

## Contributing
Contributions are welcome! Please open an issue or submit a pull request.

