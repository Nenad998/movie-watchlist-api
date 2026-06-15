# Movie Watchlist API

## Overview

Movie Watchlist API allows authenticated users to manage their personal movie watchlist.

When a movie is added to the watchlist, the application uses the OMDb API to fetch additional movie details and store them locally in the database.

All watchlist endpoints are protected and available only to authenticated users.

---

## Technologies

* PHP 8.2
* Laravel 12
* MySQL
* Laravel Sanctum
* OMDb API

---

## Project Setup

1. Clone the repository

```bash
git clone <repository-url>
```

2. Install dependencies

```bash
composer install
```

3. Create the `.env` file

```bash
cp .env.example .env
```

4. Configure the database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movie_watchlist_api
DB_USERNAME=root
DB_PASSWORD=
```

5. Add your OMDb API key

```env
OMDB_API_KEY=your_api_key
OMDB_API_URL=https://www.omdbapi.com/
```

6. Generate the application key

```bash
php artisan key:generate
```

7. Run database migrations

```bash
php artisan migrate
```

8. Start the application

```bash
php artisan serve
```

---

## Authentication

Laravel Sanctum was used for authentication.

I chose Sanctum because it provides a simple and natural solution for token-based API authentication in Laravel applications without introducing unnecessary complexity.

---

## API Endpoints

### Authentication

```http
POST /api/register
POST /api/login
POST /api/logout
```

### Watchlist

```http
GET    /api/watchlist
POST   /api/watchlist
GET    /api/watchlist/{id}
PATCH  /api/watchlist/{id}
DELETE /api/watchlist/{id}
```

Filtering by status is supported:

```http
GET /api/watchlist?status=watched
```

Pagination is also supported:

```http
GET /api/watchlist?per_page=10
```

---

## OMDb API Integration

When a movie is added to the watchlist, the application:

1. Receives either an IMDb ID or a movie title
2. Calls the OMDb API
3. Maps the response into the application's internal data structure
4. Stores the movie in the local database
5. Creates a watchlist entry for the authenticated user

Movies are stored only once in the `movies` table, while the `watchlist_items` table stores user-specific information such as status, notes, and personal ratings.

This approach helps avoid duplicate movie records.

---

## Decisions Made During Development

The main goal was to keep the solution simple, easy to understand, and easy to extend.

Business logic was moved out of controllers to keep the endpoints clean and focused on handling HTTP requests and responses.

When a movie is added to the watchlist, the application fetches movie details from the OMDb API and stores them locally. This avoids unnecessary external API calls every time the watchlist is displayed.

Movies are stored only once in the database, while each user has their own watchlist entries containing user-specific information such as status, notes, and personal rating.

When designing the API, the focus was on consistent responses, predictable URLs, and appropriate HTTP status codes.

---

## What I Would Improve With More Time

* Add automated tests for the most important scenarios
* Introduce caching for OMDb API requests
* Improve error handling with custom exception classes
* Add API documentation
* Support more advanced filtering and sorting options for watchlist items
