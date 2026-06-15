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
