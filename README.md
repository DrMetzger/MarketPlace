Dr. Metzger's Programming Doctor - Marketplace Project
Welcome to Dr. Metzger's Programming Doctor Marketplace project! This repository contains a PHP application built on PHP version 8.2.7. The project aims to provide a comprehensive and efficient marketplace solution. Please note that this README file will provide an overview of the project structure, functionality, and important instructions for setting up and running the application.

Table of Contents
Project Structure
Installation
Configuration
Usage
Contributing
License
Project Structure
The project is organized into several directories, each serving a specific purpose. Here's a breakdown of the directory structure:

action: This directory contains files responsible for communication with the database and user authentication using JSON Web Tokens (JWT).

api: Handles all database interactions and includes JWT security for user login and database manipulation.
connectdb: Provides the database connection configuration for SQL Server. Make sure to use the correct DLLs based on your PHP version.
secure: Verifies the validity of the JWT token and restricts access to the system without a valid token.
css: Contains all the CSS stylesheets and classes used for the marketplace theme.

db_sql_server: Includes a complete backup of the database in .bak format. You can use this backup to restore the database.

domain: Specifies the base URL used throughout the site. Make sure to configure it correctly for all links to work properly. An example is already provided: http://localhost:8000.

img: Contains images such as logos and backgrounds used in the marketplace.

js: Contains JavaScript classes used in the application.

modal: Includes modal templates for various registration screens.

navbar: Contains the navigation bar with the menu at the top and icons for each access description. The footer also includes copyright information for all pages.

style: Contains custom styles for the body of the marketplace.

vendor: Includes various plugins utilized in the project, such as Bootstrap, Composer, Firebase, jQuery, jQuery Easing, and Select2.

index.php: serves as the starting point of the application and prompts the user for login credentials. The default login is "admin" with the password "7788!@". Ensure that the database and other dependencies, including JWT, are properly configured according to the JWT manual.

portal.php: Represents the main screen displayed after successful login.

products.php: Responsible for product registration. Please ensure that you first add the product type to load it correctly in the product type dropdown.

tipo_de_produto.php: Handles product types registration.

taxes.php: Manages the tax rates associated with product types. Before registering a tax rate, make sure the product type is already registered.

sales.php: Represents the sales screen, including tax calculations and recording sales. Pay attention to the initial registrations to ensure correct calculations for tax and totals.

exit.php: Provides a secure way to close and destroy the JWT token.

Please respect the author's request not to share or distribute the code online. The project represents significant effort, with more than 20 hours of work dedicated to its development.

Installation
To set up the Dr. Metzger's Programming Doctor Marketplace project locally, please follow these steps:

Clone the repository to your local machine using the following command:

bash
Copy code
git clone https://github.com/your_username/repository_name.git
Ensure you have PHP version 8.2.7 or compatible installed on yoursystem.

Configure your web server (e.g., Apache or Nginx) to point to the project's root directory.

Install the required dependencies by running the following command in the project's root directory:

Copy code
composer install
Configuration
Before running the application, you need to perform some configuration steps:

Database Configuration:

Ensure that the SQL Server database is set up and running.
Import the provided database backup file (db_sql_server/backup.bak) into your SQL Server instance.
Update the database connection configuration in action/connectdb to match your environment, including the correct DLLs for your PHP version.
JWT Configuration:

Review the JWT documentation to properly configure JWT for user authentication and authorization in the action/api directory.
Make sure to update the JWT configuration in the application according to the JWT manual.
Base URL Configuration:

Update the domain file to specify the correct base URL for your local environment.
Usage
Once you have completed the installation and configuration steps, you can start using the Dr. Metzger's Programming Doctor Marketplace application:

Access the application by navigating to the configured base URL in your web browser.

You will be prompted to enter your login credentials. Use the default login credentials: Username: "admin" and Password: "7788!@".

After successful login, you will be redirected to the main portal (portal.php), where you can explore the marketplace's features.

Various registration screens are available for managing products, product types, taxes, and sales. Ensure that you follow the correct registration order to calculate taxes and totals accurately.

On each registration screen, you will find an "Export to Excel" button for exporting the corresponding data (products, product types, taxes, and sales) to an Excel file.

When you are finished using the application, navigate to the "Exit" page (exit.php) to securely close and destroy the JWT token.

Contributing
Contributions to Dr. Metzger's Programming Doctor Marketplace project are currently not open to the public. However, if you have any suggestions or feedback, feel free to contact the project owner directly on GitHub.

License
The Dr. Metzger's Programming Doctor Marketplace project is not currently licensed for public use. All rights reserved by Dr. Metzger.
