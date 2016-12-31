# **Hair Salon**

##### A website that allows a hair salon to keep track of stylists and their clients. It will use php, silex, twig, mysql, phpunit, and symphony functional tests). 12/2016
#
##### By [Alexandre Leibler](https://github.com/KomodoTech) :dragon_face:
#
![screenshot of project main page](demo-screenshot.tiff)

---
### **Description**

> Each stylist can have many clients, but a client can only have one stylist at a time (one-to-many). The backend code is fairly straightforward but has a few nifty methods for finding stylists and clients by id or name. The controller (app.php) code takes care of routing and experiments with keeping the number of routes small by passing values to the view files (through twig) which display differently depending on what options are passed in. The frontend also uses partials to avoid repetition of code.
#
---
### **Specifications**

#### NOTE: ASSUME DATABASE STARTS EMPTY

| _Behavior_ | _Input_ | _Output_ |
|------------|---------|----------|
|            |         |          |
| View front page (no data) | None | Display Message No Clients/Stylists Found, Display option to add stylist |
|            |         |          |
| Add stylist | stylist_name (string) -> click create stylist button | Display Message No Clients Found + Display stylist_name under Stylists section + Display option to add stylist + Display option to add client with stylist selection dropdown + Display Delete All button |
|            |         |          |

#
#
#
---
### **Setup/Installation Requirements ( * Nix)**

_If you wish to view the site locally on your machine please follow the following steps:_

#####  1). Navigate to the directory in which you want the hairSalon project to reside.
#

#####  2). Enter the following command into your terminal:

```
git clone https://github.com/KomodoTech/hairSalon.git
```

#
#####  3). Navigate to the hairSalon directory, and execute the following command in the terminal:

```
composer install
```

#
#####  4). To replicate the production database used by this app, use your preferred server stack (e.g. MAMP, LAMP, etc.) to launch a mysql server.

 >#### :exclamation: _NOTE_:
 >The database configuration in the php files will need to match your setup. The default is set to port localhost:8889, username:root, password:root


#
#
#####  5). Once you have your mysql server properly setup, run the following commands in your mysql shell:

```
CREATE DATABASE hair_salon;
CREATE DATABASE hair_salon_test;
```

#####  6). To replicate the settings used for these databases either navigate to the local phpMyAdmin page and import the _hair_salon.sql.zip_ file which resides inside the databases directory, or execute the following commands in your mysql shell:

```
USE hair_salon_test;
CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);
USE hair_salon;
CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), sylist_id INT);
```

#####  7). Navigate to the web directory and start your local host by executing the following command in your terminal:

```
php -S localhost:8000
```

#####  8). Open up the browser of your choice and go to the following url:

http://localhost:8000/

#####  9). To run tests from the root project directory execute the following command in the terminal:

```
vendor/phpunit/phpunit/phpunit
```

#####  10). If you wish to look at the source code, feel free to browse through the files in the hairSalon directory


---
### **Todo**
- [ ] Implement full substring search
- [ ] Write functional tests
- [x] Update README.md

#

---
### **Known Bugs**
None

---
### **Support and contact details** :email:

For comments or questions, please email alexandre.leibler@gmail.com

---
### **Technologies Used**

* silex v~2.0
* twig v~1.0
* phpunit v5.5.*
* bootstrap v3.3.7
* symphony v3.2

---
### **License**

GPL-3.0

---
hairSalon Copyright (c) 2016 **Alexandre Leibler**
