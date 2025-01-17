# Bit Academy

# Forms & Validation

### Installation

1. Download and extract the zip file.
2. Run `composer install` from command line.
3. In case of any problems you may need to run `composer update` first.
4. Copy `.env.example` to `.env`.
5. Run `php artisan key:generate` from the command line.
6. Migrate: Run `php artisan migrate` from the command line. This wil also create the SQLite database.
7. Seed: Run `php artisan db:seed` from the command line.
8. Vite: `npm run dev`.
9. `php artisan serve`

### Intro

The repository is structured with separate commits for each exercise in the Eloquent - Being relatable module. This allows you to review each stage of the module independently, making it easier to provide targeted feedback.
Please refer to the specific commits to see the progress and implementation details for each of the four exercises.

### 3.Form Requests → 1.Form Requests

- Copy project from last exercise
- Created 3 requests: `StoreBookRequest & UpdateBookRequest & DeleteBookRequest` and moved validation-logic from controller.
- `Bookscontroller`: Add the requests to the parameters of the controller methods.

### 3.Form Requests → 2.Authorization

- Updated `TIMESTAMP_create_books_table`-migration add `user_id` with default value `1`.
- In the Requests `authorize()` checks if the `Book->user_id` === `1`.