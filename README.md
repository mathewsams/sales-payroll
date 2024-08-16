# Payroll Date Generator

A simple laravel CLI tool to identify the salary date of employees for the given year and Generate CSV report.

## Installation

Download the app to a local web server and run the below artisan command in terminal.  

```bash
php artisan sales:pay-dates [year]
```

## Run Locally

Clone the project

```bash
  git clone https://github.com/mathewsams/sales-payroll
```

Go to the project directory

```bash
  cd sales-payroll
```

Run artisan command

```bash
Command argument is optional

# Default year is the current year. Data of the remaining months of the year is generated
php artisan sales:pay-dates

# Generate details of a specific year
php artisan sales:pay-dates 2023

```

## CSV Report

The command will display in terminal and generate a CSV files the salary payment dates for the calculated year.

Generated CSV file is stored in the below application path.

```bash
storage/app/employee_[year].csv
```
## Tech

PHP 8.1, Laravel 10.0

## License

[MIT](https://choosealicense.com/licenses/mit/)
