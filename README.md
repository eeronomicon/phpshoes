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

* Able to retrieve Brand name
  * Input: database record for Brand named "Jhonn Flubog"
  * Output: "Jhonn Flubog"

* Able to retrieve Brand ID Number
  * Input: database record for Brand named "Jhonn Flubog", ID Number of 1
  * Output: 1

* Can record Brand information into database
  * Input: Brand named "Jhonn Flubog"
  * Output: create and retrieve "Jhonn Flubog" from database

* Can replace Brand name with new name
  * Input: new name for "Jhonn Flubog" - "Jhonny B Flubog"
  * Output: updated name - "Jhonny B Flubog"

* Able to retrieve all Brands
  * Input: database with the Brands "Jhonn Flubog", "Doc Merkins", "Fried Boots"
  * Output: retrieved the list "Jhonn Flubog", "Doc Merkins", "Fried Boots"

* Can remove all Brands from database
  * Input: database with the Brands "Jhonn Flubog", "Doc Merkins", "Fried Boots"
  * Output: retrieved an empty list

* Can find Brand based on ID Number
  * Input: database record for Brand named "Jhonn Flubog", ID Number of 1, finding Brand with ID Number of 1
  * Output: "Jhonn Flubog"'s database record

* Can update Brand record with new name
  * Input: new name for "Jhonn Flubog" saved in database - "Jhonny B Flubog"
  * Output: retrieved "Jhonny B Flubog" from database

* Can remove Brand record from database
  * Input: remove "Jhonn Flubog" from database containing "Jhonn Flubog", "Doc Merkins", "Fried Boots"
  * Output: only "Doc Merkins" and "Fried Boots" remain in database

* Can add a Brand to a Store
  * Input: associate "Jhonn Flubog" Brand with "Sole Man" Store
  * Output: a query of all Brands associated with "Sole Man" returns "Jhonn Flubog"

* Can add multiple Brands to a Store
  * Input: associate "Jhonn Flubog" and "Doc Merkins" Brand with "Sole Man" Store
  * Output: a query of all Brands associated with "Sole Man" returns "Jhonn Flubog" and "Doc Merkins"

* Can view all Stores associated with a Brand
  * Input: associate "Doc Merkins" with "Footsies" and "Sole Man"
  * Output: a query of "Doc Merkins" shows "Footsies" and "Sole Man" as Stores

* Can add a Store to a Brand
  * Input: associate "Sole Man" Store with "Jhonn Flubog" Brand
  * Output: a query of all Stores associated with "Jhonn Flubog" returns "Sole Man"

* Retrieve a list of Brands NOT associated with a Store
  * Input: "Jhonn Flubog" is associated with "Sole Man", "Doc Merkins" is not
  * Output: Querying "Sole Man" returns "Doc Merkins"

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

This app uses the following bits of Human ingenuity: HTML5, JavaScript, PHP, mySQL, jQuery, and Bootstrap.

### License

Published under the MIT License.

Copyright (c) 2016 **_HK Kahng_**
