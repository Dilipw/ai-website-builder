# AI Website Builder (Laravel API)

A backend API system where authenticated users can generate structured website content using custom AI logic and manage it securely through RESTful APIs.

## Objective

The goal of this project is to design and implement a backend system that simulates an AI-powered website content generator. Users provide business details, and the system generates structured website content using internally defined logic instead of external AI APIs.

This project demonstrates:

- Backend architecture design
- API development
- Database structuring
- Code organization and scalability
- Handling real-world constraints such as rate limiting and performance

## System Overview

The system follows a simple request-response lifecycle:

1. User registers or logs in
2. User submits business details
3. Custom AI service processes input
4. Website content is generated
5. Data is stored in the database
6. User can manage the generated content

This simulates a simplified SaaS content generation platform.

## Features
- Authentication using Laravel Sanctum
- Custom AI-based content generation
- CRUD operations for website data
- Pagination for large datasets
- Input validation and authorization
- Rate limiting (5 requests per user per day)
- Caching to avoid duplicate content generation
- Structured API response format

## AI Content Generation

The system generates the following:

- Website Title
- Tagline
- About Section
- Services List

This is achieved using a custom service layer that:

- Uses predefined templates
- Applies conditional logic
- Generates dynamic responses
- Mimics AI-like behavior without external APIs

## Architecture

The system follows a layered architecture:

### Controller Layer

Handles HTTP requests, validation, and communication with services.

### Service Layer

Contains business logic for content generation. Keeps logic modular and maintainable.

### Model Layer

Manages database interactions and relationships.

### Authentication Layer

Secures APIs using token-based authentication.

## Database Design

A single table `websites` is used to store both user input and generated output.

Fields include:

- user_id
- business_name
- business_type
- description
- title
- tagline
- about
- services (JSON)
- timestamps

## Design Decisions
- Single table to avoid joins and keep structure simple
- JSON used for flexible service storage
- Each record linked to authenticated user

## API Endpoints

### Authentication
- POST /api/register
- POST /api/login

### Websites (Protected)
- GET /api/websites
- POST /api/websites
- GET /api/websites/{website}
- PUT /api/websites/{website}
- DELETE /api/websites/{website}

### Request Headers (Protected APIs)

```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

## Additional Features

### Rate Limiting

Users are restricted to 5 content generations per day.

### Prompt and Response Storage

Both user input and generated output are stored for tracking and reuse.

### Caching

Duplicate requests are optimized using caching to avoid repeated processing.

## Security
- Authentication using Sanctum
- Authorization ensures users access only their own data
- Input validation to maintain data integrity
- Exception handling with proper logging
- Protection against unauthorized access

## Performance Considerations
- Pagination reduces response size
- Caching improves response time
- Rate limiting prevents system overload
- Database indexing improves query performance
- Queue system can be introduced for async processing

## Failure Handling
- Exceptions are handled using try-catch
- Errors are logged for debugging
- API returns consistent error responses
- System avoids crashes due to failures

## Extensibility

The system is designed for future enhancements:

- Replace custom AI with real AI APIs (OpenAI, Gemini, etc.)
- Add queue processing for scalability
- Introduce analytics and personalization
- Extend database structure if needed

## Tech Stack
- Laravel 12
- Laravel Sanctum
- SQLite (development)
- REST API architecture

## Setup
```bash
git clone <repository>
cd project

composer install
cp .env.example .env

php artisan key:generate
php artisan migrate

php artisan serve
```

## Key Highlights
- Clean separation of concerns (Controller, Service, Model)
- Custom AI simulation without external dependency
- Scalable and maintainable architecture
- Real-world features like rate limiting and caching
- Ready for production-level extension

## One-line Summary

A scalable backend system where authenticated users can generate and manage website content using custom AI logic with a clean and extensible architecture.

## Author

Dilip Waghmare



