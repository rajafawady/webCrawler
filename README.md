# Web Crawler

## Overview

This GitHub repository contains a web crawler implemented in PHP for searching keywords in the content of web pages. The crawler can perform a fresh crawl or search within previously crawled results. The system consists of a front-end implemented in HTML, CSS, and JavaScript, and a back-end implemented in PHP.

## Features

- **Web Crawling**: The crawler can be initiated through a user interface to search for a keyword on specified web pages up to a certain depth.
- **Result Storage**: Crawled results are stored in JSON format for efficient retrieval and display.
- **Search Within Results**: Users can search for a keyword within the previously crawled results using a separate interface.
- **Robots.txt Compliance**: The crawler adheres to the rules specified in the `robots.txt` file of websites to respect their crawling policies.

## Technologies Used

- **Front-end**: HTML, CSS, JavaScript
- **Back-end**: PHP
- **Database**: MySQL (for storing keyword information)
- **Concepts**: Web Crawling, DOM Parsing, Asynchronous JavaScript (AJAX), JSON Handling, Database Interaction

## Setup Instructions

### Prerequisites

1. Web Server (e.g., Apache, Nginx) with PHP support
2. MySQL Database
3. PHP installed on the server

### Steps

1. **Clone the Repository**

   ```bash
   git clone https://github.com/rajafawady/web-crawler.git
   ```

2. **Database Setup**

  - Import the provided SQL file "db/dbsearch.sql" into your MySQL database to create the necessary tables.

3. **Configure Database Connection**

   - Open `config/connection.php` and update the database connection details (hostname, username, password, database).

4. **Configure File Paths**

   - Update file paths in the PHP files if your directory structure differs.

5. **Set Permissions**

   - Ensure that the web server has the necessary permissions to read and write files (for JSON storage).

6. **Run the Application**

   - Access the application through a web browser by navigating to the URL: "localhost/(folder_name that consists project files)"

## Usage

### Crawling

1. Enter the URL and depth on the search form.
2. Click the "Search" button.
3. The crawler will display a loading animation, and once completed, it will redirect you to a page where you can search for desired keywords in crawled data.
4. All the crawled data will be stored in jsondata folder, one json file for each unique url.

### Searching Within Results

1. After redirection you'll have a search bar to search in crawled results.
2. This page can only be accessed through index.html by crawling a url first, you cannot access this page directly
3. Enter the keyword and the ID of the previous crawl.
4. Click the "Search" button.
5. Matching URLs containing the entered keyword will be displayed.

## Troubleshooting

- If the crawler is not working as expected, check the console for JavaScript errors and the PHP error logs for server-side issues. Or you can contact me at rajafawady@gmail.com

## Contributions

Contributions are welcome! Feel free to open issues, submit pull requests, or suggest improvements.
