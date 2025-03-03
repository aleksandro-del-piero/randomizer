# Laravel Application Setup with Sail

This guide will walk you through the steps to clone, set up, and run the Laravel application using Laravel Sail.

## Requirements

- Docker
- Docker Compose
- PHP (optional, Sail will handle the PHP environment for you)

## Steps to Run the Application

### 1. Clone the Repository

Start by cloning the repository to your local machine:

```bash
git clone https://github.com/aleksandro-del-piero/randomizer.git

cd randomizer

cp .env.example .env

curl -sS https://getcomposer.org/installer | php

php composer.phar install

touch database/database.sqlite

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan migrate

Open in your browser:

http://localhost:8080
