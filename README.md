# hairSalon

#### A website that allows a hair salon to keep track of stylists and their clients. It will use php, silex, twig, mysql, and tests (phpunit). 10.07.16

#### By **Alexandre Leibler**


## Description

_Each stylist can have many clients, but a client can only have one stylist at a time (one-to-many). The backend code is fairly straightforward but has a few nifty methods for finding stylists and clients by id or name. The controller (app.php) code takes care of routing and experiments with keeping the number of routes small by passing values to the view files (through twig) which display differently depending on what options are passed in. The frontend also uses partials to avoid repetition of code._


## Setup/Installation Requirements

_If you wish to view the source code locally on your machine please follow the following steps:_

  +  1). Navigate to the directory in which you want the hairSalon project to reside.

  +  2). Enter the following command into your terminal:
        git clone https://github.com/KomodoTech/hairSalon.git

  +  3). Navigate to the hairSalon directory, and execute the following command in the terminal:
          composer install
  
  +  4). To replicate the production database used by this app use your preferred server stack (e.g. MAMP, LAMP, etc.) to   
         launch a mysql server (using port localhost:8889, username:root, password:root, or changing the database 
         configuration in the php files to match your setup).
  
  +  5). Once you have your mysql server properly setup, run the following commands in your mysql shell:
         
            CREATE DATABASE hair_salon;
            CREATE DATABASE hair_salon_test;
  
  +  6). To replicate the settings used for these databases either navigate to the local phpMyAdmin page and import the 
         _localhost.sql.zip_ file which resides inside the databases directory, or execute the following commands in your 
         mysql shell:
         
           USE hair_salon_test;
           CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
           CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);
           USE hair_salon;
           CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
           CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), sylist_id INT);

  +  7). Navigate to the web directory and start your local host by executing the following command in your terminal:
          php -S localhost:8000

  +  8). Open up the browser of your choice and go to the following url:
          http://localhost:8000/

  +  9). If you wish to look at the source code, feel free to browse through the files in the hairSalon directory


## Specs

* 1). View Stylists/Clients
  + IN:  
  + OUT: 

* 2). Add Stylist
  + IN:  
  + OUT: 

* 3). Add Client To Stylist
  + IN:  
  + OUT: 

* 4). View Client/Stylist Details
  + IN:  
  + OUT: 

 * 5). Edit Client/Stylist Name
  + IN:  
  + OUT: 

* 6). Edit Client Stylist
  + IN: 
  + OUT: 

* 7). Delete All Clients and Stylists
  + IN:
  + OUT:

* 8). Delete Specified Client/Stylist
  + IN:
  + OUT:
  
* 9). Search Client/Stylist by Id
  + IN:
  + OUT:
 
* 10). Search Client/Stylist by Name
  + IN:
  + OUT:

## Known Bugs

+ Full substring searching has not yet been implemented


## Support and Contact Details

Please feel free to contact me through my github account (KomodoTech) or at the following email:
    alexandre.leibler@gmail.com

## Technologies Used

* silex v~2.0
* twig v~1.0
* phpunit v5.5.*
* bootstrap v3.3.7



### License

* GPLV3

hairSalon Copyright (c) 2016 **Alexandre Leibler**
