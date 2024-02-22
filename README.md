
# Yuki Kuro Portofolio Website

This repository contains the source code for my brother [Yuki Kuro](https://instagram.com/yukikuro___)'s portfolio website. It was developed using Laravel, Tailwind CSS, and Flowbite.

## Table of Contents

- [About](#about)
- [Technologies Used](#technologies-used)
- [Setup](#setup)
- [Usage](#usage)

## About

This portfolio website serves as a showcase of my projects, skills, and experiences. It provides visitors with information about my work and allows them to get in touch with me.

## Technologies Used

- **Laravel**: Laravel is a PHP web application framework used for developing robust and maintainable web applications.
- **Tailwind CSS**: Tailwind CSS is a utility-first CSS framework for building custom designs without having to leave your HTML.
- **Flowbite**: Flowbite is a Tailwind CSS component library that provides additional UI components and utilities.

## Setup

1. **Clone the repository:**
   ```
   git clone https://github.com/dedekanandaa/Laravel-YukiKuro.git
   ```

2. **Install dependencies:**
   ```
   composer install
   npm install
   ```

3. **Set up environment variables:**
   ```
   cp .env.example .env
   php artisan key:generate
   ```

   Update the `.env` file with your database configuration and any other necessary settings.

4. **Run migrations:**
   ```
   php artisan migrate
   ```

5. **Compile assets:**
   ```
   npm run dev
   ```

6. **Serve the application:**
   ```
   php artisan serve
   ```

## Usage

Once the setup is complete, visit `http://localhost:8000` in your web browser to view the website.