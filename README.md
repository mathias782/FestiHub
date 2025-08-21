# FestiHub

## Overview
FestiHub is a Laravel 11 web app where visitors discover music events, view public profiles, and register for events. Admins manage users, events (with performers), FAQ, and see registrations.

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
- Submit a question to an existing category

**Contact**
- Send message via contact form (email to admin)

---

## Installation

### Requirements
- PHP 8.2+
- Node.js
- Composer
- MySQL
- Webserver ( Apache, Nginx, ...)

### Setup Instructions
1. **Clone**
   ```bash
   git clone https://github.com/mathias782/FestiHub
   cd FestiHub

2. **Install dependencies**
   ```bash
   composer install
   npm install

3. **Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate

Configure DB (DB_*) and Mail (MAIL_*).

4. **Build assets**
   ```bash
   npm run build

4. **Database**
   ```bash
   php artisan migrate:fresh --seed
   php artisan storage:link

Default admin:
Email: admin@ehb.be — Password: Password!321

4. **Run**
   ```bash
   php artisan serve

## Technologies

- Laravel 11

- MySQL/MariaDB

- Tailwind CSS

## Sources

[Laravel Docs](https://laravel.com/)

[Laravel Tutorial for beginners](https://www.youtube.com/watch?v=cDEVWbz2PpQ)
