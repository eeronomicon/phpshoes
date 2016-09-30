# _Shoe Fly!_

#### _PHP/mySQL Project Demonstrating Many-to-Many Relationships, 30 September 2016_

#### By _**HK Kahng**_

## Description

Exercise objectives: Write a program to list out local shoe stores and the brands of shoes they carry. Make a Store class and a Brand class.

## Specifications



## Setup/Installation Requirements

### Database Setup

* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (id serial PRIMARY KEY, name varchar (255));
* CREATE TABLE brands (id serial PRIMARY KEY, name varchar (255));
* CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);
* Make a copy of shoes as shoes_test (Structure Only).

### Application Setup

* Unzip and import production and test databases into mySQL.
* Adjust mySQL port as appropriate based on your local server's settings.
* Start the PHP server in the application's /web directory.
* Open a web browser to the server's root.

## Known Bugs

There are no known bugs in this application.

## Support and contact details

Contact me via GitHub!

## Technologies Used

_{Tell me about the languages and tools you used to create this app. Assume that I know you probably used HTML and CSS. If you did something really cool using only HTML, point that out.}_

### License

Published under the MIT License.

Copyright (c) 2016 **_HK Kahng_**
