# Kontak Simple
Built with ❤️ and Laravel Sail

## Setup

Run Composer to install the composer packages 

```bash
 composer install
 ```
Setup your local .env by running the below command or manually copy .env.example to a new file called .env
```bash
 cp .env.example .env
 ```
Within the root directory of this project run, to bring the containers up
```bash
./vendor/bin/sail up
```
Generate your unique `APP_KEY`
```bash
./vendor/bin/sail artisan key:generate
```

Before running the above command, be sure to free-up default ports from these applications:
- Apache/Nginx `:80`
- MySQL/MariaDB `:3306`
- MailHog `:1025`
- meilisearch `:7700`
- redis `:6379`

Run you migration, to create the database tables
```bash
./vendor/bin/sail artisan migrate
```
Seed the data using the below command. This command will create 10 Kontaks and 2 Admins
```bash
./vendor/bin/sail artisan db:seed
```

### Admin details
The Two Admins have the same password `!Admin321`
and the usernames/emails are `sibongiseni.msomi@outlook.com` and `demo@demo.test`

## Running the Application
Once everything is all setup, you can run the application from `localhost` or `http://kontak-simple.test`

## Emails
The system uses database queues to send out emails, so it's important to run the below command, and keep it running to ensure the emails are sent through.
```bash
./vendor/bin/sail artisan queue:work
```
