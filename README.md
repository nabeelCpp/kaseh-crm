# kaseh-crm

Step1: Open Cli window and write command where you want to deploy the project in directrory `git clone git@github.com:nabeelCpp/kaseh-crm.git`

Step2: Navigate to the Cloned Project Directory: `cd kaseh-crm`

Step3: Install Composer Dependencies `composer install`

step4: Install npm packages `npm install`

Step5: Create a Copy of the .env File from .env-example file: `cp .env.example .env`

Step6: Generate an Application Key: `php artisan key:generate`

Step7: Configure the Database: Open the .env file and configure the database connection settings, including the database name, username, and password.

Step8: Migrate the Database: `php artisan migrate`
