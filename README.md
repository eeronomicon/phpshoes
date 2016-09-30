# _Shoe Fly!_

#### _PHP/mySQL Project Demonstrating Many-to-Many Relationships, 30 September 2016_

#### By _**HK Kahng**_

## Description

Exercise objectives: Write a program to list out local shoe stores and the brands of shoes they carry. Make a Store class and a Brand class.

## Specifications

* Able to retrieve Store name
  * Input: database record for Store named "Footsies"
  * Output: "Footsies"

* Able to retrieve Store ID Number
  * Input: database record for Store named "Footsies", ID Number of 1
  * Output: 1

* Can record Store information into database
  * Input: Store named "Footsies"
  * Output: create and retrieve "Footsies" from database

* Can replace Store name with new name
  * Input: new name for "Footsies" - "Footers"
  * Output: updated name - "Footers"

* Able to retrieve all Stores
  * Input: database with the Stores "Footsies", "Sole Man", "Boots and Snoots"
  * Output: retrieved the list "Footsies", "Sole Man", "Boots and Snoots"

* Can remove all Stores from database
  * Input: database with the Stores "Footsies", "Sole Man", "Boots and Snoots"
  * Output: retrieved an empty list

* Can find Store based on ID Number
  * Input: database record for Store named "Footsies", ID Number of 1, finding Store with ID Number of 1
  * Output: "Footsies"'s database record

* Can update Store record with new name
  * Input: new name for "Footsies" saved in database - "Footers"
  * Output: retrieved "Footers" from database

* Can remove Store record from database
  * Input: remove "Footsies" from database containing "Footsies", "Sole Man", "Boots and Snoots"
  * Output: only "Sole Man" and "Boots and Snoots" remain in database


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
