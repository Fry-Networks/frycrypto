**Laravel Project Environment Configuration Guide**

Overview
This document serves as a guide for setting up the environment for the Laravel project which includes two main subdomains: verify and explorer. In addition to configuring these subdomains, you will also set up Google and PureStake API keys, and database details before running the Laravel setup commands.

**Environment Variables Setup**

To begin the setup, you will need to configure several environment variables that the Laravel application will use. Here is the step-by-step process to set these variables in your .env file.

**Subdomains Configuration**

The project uses two distinct subdomains to separate functionalities. The following variables need to be added to the .env file:
For the verify subdomain:
VERIFY_DOMAIN=http://verify.frycrypto.test
For the explorer subdomain:
EXPLORER_DOMAIN=http://explorer.frycrypto.test

**API Keys Configuration**

The application requires API keys for Google and PureStake services. Add these to your .env file as follows:
Google API Key:
GOOGLE_API_KEY=
PureStake API Key:
PURESTAKE_API_KEY=
Replace your_google_api_key and your_purestake_api_key with the actual API key.

**Database Configuration**

Add your database details to the .env file. Ensure you have the following information:

Database connection (mysql):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Make sure to replace the placeholders (e.g., your_database_name, your_database_username, your_database_password) with your actual database details.

**Laravel Setup Commands**

After configuring your .env file, you will need to run the following commands to set up the Laravel application:
•	Install Composer dependencies:
composer install
•	Generate an application key:
php artisan key:generate
•	Run migrations to set up the database schema:
php artisan migrate
•	Seed the database with initial data:
php artisan db:seed
•	Clear the configuration cache:
php artisan config:cache

**Final Steps**
After running these commands, application should be configured and ready to serve on the specified subdomains. Ensure that your web server is correctly configured to point verify and explorer subdomains to the public directory inside the root. 
