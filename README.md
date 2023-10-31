
## Installation

Install the project:

```bash
  cp .env.example .env
  composer install
```
    
Fill env file with old and new DB and Schema info

```bash
  DB_HOST_SIMS_OLD_SCHEMA=127.0.0.1
  DB_PORT_SIMS_OLD_SCHEMA=3306
  DB_DATABASE_SIMS_OLD_SCHEMA=crm_setting_schema
  DB_USERNAME_SIMS_OLD_SCHEMA=root
  DB_PASSWORD_SIMS_OLD_SCHEMA=

  DB_HOST_SIMS_OLD=127.0.0.1
  DB_PORT_SIMS_OLD=3306
  DB_DATABASE_SIMS_OLD=sims_crm_db
  DB_USERNAME_SIMS_OLD=root
  DB_PASSWORD_SIMS_OLD=

  DB_HOST_SIMS_NEW=127.0.0.1
  DB_PORT_SIMS_NEW=3306
  DB_DATABASE_SIMS_NEW=sims_new
  DB_USERNAME_SIMS_NEW=root
  DB_PASSWORD_SIMS_NEW=
```

## Run All Migrations

Run Migration 
```bash
  php artisan sims:migrate
```

## Run part of All Migrations
Migrate users from old to new database
```bash
  php artisan sims:migrate-users
```
Migrate sales from old to new database
```bash
  php artisan sims:migrate-sales
```
Migrate purchases from old to new database
```bash
  php artisan sims:migrate-purchases
```
Migrate expenses from old to new database
```bash
  php artisan sims:migrate-expenses
```
Migrate inventories from old to new database
```bash
  php artisan sims:migrate-inventories
```
Migrate vouchers from old to new database
```bash
  php artisan sims:migrate-vouchers
```
Migrate meetings from old to new database
```bash
  php artisan sims:migrate-meetings
```
Migrate tasks from old to new database
```bash
  php artisan sims:migrate-tasks
```
