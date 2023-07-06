# Dr. Metzger's Programming Doctor - Marketplace Project

Welcome to Dr. Metzger's Programming Doctor Marketplace project! This repository contains a PHP application built on PHP version 8.2.7. The project aims to provide a comprehensive and efficient marketplace solution. Please note that this README file will provide an overview of the project structure, functionality, and important instructions for setting up and running the application.

## Table of Contents

1. [Project Structure](#project-structure)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Usage](#usage)
5. [Contributing](#contributing)
6. [License](#license)

## Project Structure

The project is organized into several directories, each serving a specific purpose. Here's a breakdown of the directory structure:

- **action:**
  - **api:** Responsible for all communication with the database, including the JWT security for login and database operations.
  - **connectdb:** Handles the database connection and configuration for SQL Server. Make sure to use the correct DLLs for your PHP version.
  - **secure:** Verifies the validity of the JWT token and restricts access to the system without a valid token.

- **css:** Contains all the classes and styles for the marketplace theme.

- **db_sql_server:** Includes a complete backup of the database in .bak format. You can use this backup to restore the database.

- **domain:** Specifies the base URL used throughout the site. Make sure to configure it correctly for all links to work properly. An example is already provided: http://localhost:8000.

- **img:** Contains images such as logos and backgrounds used in the marketplace.

- **js:** Contains JavaScript classes used in the application.

- **modal:** Includes modal templates for various registration screens.

- **navbar:**
  - **navbar:** Contains the navigation bar with the menu at the top and icons for each access description.
  - **footer:** Contains the copyright information for all pages.

- **style:** Contains custom styles for the marketplace's body.

- **vendor:** Contains various plugins used in the project, including Bootstrap, Composer, Firebase, jQuery, jQuery Easing, and Select2.

- **index.php:** Serves as the starting point of the application and prompts the user for login credentials. The default login is "admin" with the password "7788!@". Make sure to properly configure the database and other dependencies, including JWT, according to the JWT manual.

- **portal.php:** Represents the main screen displayed after a successful login.

- **products.php:** Responsible for product registration. Ensure that you first add the product type to load it correctly in the product type dropdown.

- **tipo_de_produto.php:** Handles product types registration.

- **taxes.php:** Manages the tax rates associated with product types. Before registering a tax rate, make sure the product type is already registered.

- **sales.php:** Represents the sales screen, including tax calculations and recording sales. Pay attention to the initial registrations to ensure correct calculations for tax and totals.

- **exit.php:** Provides a secure way to close and destroy the JWT token.

Please respect the author's request not to share or distribute the code online. The project represents significant effort, with more than 20 hours of work dedicated to its development.

## Installation

To set up the Dr. Metzger's Programming Doctor Marketplace project locally, please follow these steps:

1. Clone the repository to your local machine using the following command:

git clone https://github.com/your_username/repository_name.git


2Ensure you have PHP version 8.2.7 or compatible installed on your system.

3. Configure your web server (e.g., Apache or Nginx) to point to the project's root directory.

4. Install the required dependencies by running the following command in the project's root directory:

composer install


## Configuration

Before running the application, you need to perform some configuration steps:

1. Database Configuration:
- Ensure that the SQL Server database is set up and running.
- Import the provided database backup file (`db_sql_server/backup.bak`) into your SQL Server instance.
- Update the database connection configuration in `action/connectdb` to match your environment, including the correct DLLs for your PHP version.

2. JWT Configuration:
- Review the JWT documentation to properly configure JWT for user authentication and authorization in the `action/api` directory.
- Make sure to update the JWT configuration in the application according to the JWT manual.

3. Base URL Configuration:
- Update the `domain` file to specify the correct base URL for your local environment.

## Usage

Once you have completed the installation and configuration steps, you can start using the Dr. Metzger's Programming Doctor Marketplace application:

1. Access the application by navigating to the configured base URL in your web browser.

2. You will be prompted to enter your login credentials. Use the default login credentials: Username: "admin" and Password: "7788!@".

3. After successful login, you will be redirected to the main portal (`portal.php`), where you can explore the marketplace's features.

4. Various registration screens are available for managing products, product types, taxes, and sales. Ensure that you follow the correct registration order to calculate taxes and totals accurately.

5. On each registration screen, you will find an "Export to Excel" button for exporting the corresponding data (products, product types, taxes, and sales) to an Excel file.

6. When you are finished using the application, navigate to the "Exit" page (`exit.php`) to securely close and destroy the JWT token.

## Contributing

Contributions to Dr. Metzger's Programming Doctor Marketplace project are currently not open to the public. However, if you have any suggestions or feedback, feel free to contact the project owner directly on GitHub.

## License

The Dr. Metzger's Programming Doctor Marketplace project is not currently licensed for public use. All rights reserved by Dr. Metzger.
