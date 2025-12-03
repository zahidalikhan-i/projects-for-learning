# Laravel Project: Translator and File Converter

## Overview

This Laravel 8 application provides:

- **Language Translator UI**: A client-side page to translate text (uses static JS assets).
- **File Converter**:
  - Convert **Word (.doc/.docx)** to **PDF**
  - Convert **PDF** to **Word (.docx)**
- **Auth APIs**: Register, login, password reset, and email verification endpoints.

### Tech Stack

- **Backend**: Laravel 8.x (PHP ^7.3 | ^8.0)
- **Packages** (selected):
  - `phpoffice/phpword` (read/write .docx)
  - `dompdf/dompdf` (generate PDFs)
  - `spatie/pdf-to-text` (extract text from PDFs)
  - `laravel/sanctum` (token-based auth)

## Web Routes

- `/` → dashboard view
- `/translator` → translator UI
- `/converter` → file converter view
- `POST /convert-word-to-pdf` → Word (.doc/.docx) → PDF
- `POST /convert-pdf-to-word` → PDF → Word (.docx)
- `/show-pdf` → download last converted PDF

## API Endpoints

- `POST /api/register`
- `POST /api/login`
- `POST /api/forgot`
- `POST /api/reset`
- `GET /api/email/resend/{user}`
- `GET /api/email/verify/{id}`
- Authenticated: `GET /api/user`

## Key Controllers

- `app/Http/Controllers/Controller.php` → returns `dashboard` view
- `app/Http/Controllers/TranslatorController.php` → returns `translator` view
- `app/Http/Controllers/FileConverterController.php` → Word↔PDF conversion and file download

## Views and Assets

- Views: `resources/views/dashboard.blade.php`, `translator.blade.php`, `fileconverter.blade.php`
- Public assets:
  - CSS: `public/css/style.css`
  - JS: `public/js/countries.js`, `public/js/script.js`

## Converted Files

- Saved to: `storage/app/public/converted.pdf` and `storage/app/public/converted.docx`

## Setup

1. Install PHP dependencies:

   ```bash
   composer install
   ```

2. Create environment file and app key (first install usually auto-copies `.env`):

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

3. Configure database in `.env` (required for auth flows), then run migrations:

   ```bash
   php artisan migrate
   ```

## Run

```bash
php artisan serve
```

## Notes

- The translator page uses static JS and does not require a backend key in this repo.
- If you modify assets under `resources/*`, configure and build via your preferred bundler. Current public assets are already present under `public/`.
