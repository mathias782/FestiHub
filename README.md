# FestiHub

## Overview
FestiHub is a Laravel 11 web app where visitors discover music events, view public profiles, and register for performances. Admins manage users, events (with performers), FAQ, and see registrations.

---

## Functions

### Admin
**Users**
- Manually create users  
- Promote/Demote admin role  
- View user list

**Events**
- Create/Update/Delete events  
- Add image, location, capacity, date/time  
- Assign performers (users)  
- View registrations vs capacity

**FAQ Management**
- Add/Edit/Delete categories  
- Add/Edit/Delete questions & answers

---

### User
**Profiles**
- Public profile pages for every user  
- Edit own profile (username, birthday, avatar, about)

**Events**
- Browse events (list + detail)  
- Register/Unregister while capacity lasts

**FAQ**
- View grouped questions & answers

**Contact**
- Send message via contact form (email to admin)

---

## Installation

### Requirements
- PHP 8.2+
- Node.js 18+
- Composer
- MySQL/MariaDB (or SQLite)
- Web server (or `php artisan serve`)

### Setup Instructions
1. **Clone**
   ```bash
   git clone <repository-url>
   cd FestiHub

### Install dependencies
composer install
npm install

### Environment
cp .env.example .env
php artisan key:generate

Configure DB (DB_*) and Mail (MAIL_*).

### Build assets
npm run build

### Database
php artisan migrate:fresh --seed
php artisan storage:link

Default admin:
Email: admin@ehb.be — Password: Password!321

### Run
php artisan serve

## Technologies

- Laravel 11

- MySQL/MariaDB

- Tailwind CSS

## Sources

[Laravel Docs](https://laravel.com/)
[Laravel Tutorial for](https://www.youtube.com/watch?v=cDEVWbz2PpQ)