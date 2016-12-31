# **Hair Salon** :haircut:

##### A website that allows a hair salon to keep track of stylists and their clients. It uses php, silex, twig, mysql, phpunit, and symphony functional tests). 12/2016
#
##### By [Alexandre Leibler](https://github.com/KomodoTech) :dragon_face:

</br>

![screenshot of project main page](demo-screenshot.tiff)

</br>

---
### **Description** :bulb:

> Each stylist can have many clients, but a client can only have one stylist at a time (one-to-many). The backend code is fairly straightforward but has a few nifty methods for finding stylists and clients by id or name. The controller (app.php) code takes care of routing and experiments with keeping the number of routes small by passing values to the view files (through twig) which display differently depending on what options are passed in. The frontend also uses partials to avoid repetition of code.

</br>
</br>

---
### **Specifications** :memo:

#### NOTE: ASSUME DATABASE STARTS EMPTY

| _Behavior_                 | _Input_               | _Output_                 |
| :------------------------- | :-------------------- | :----------------------- |
|                            |                       |                          |
| **View front page (no data)** | None | <ul><li> Display Message No Clients/Stylists Found </li><li>Display option to add stylist</li></ul> |
|                            |                       |                          |
| **Add stylist** | <ol><li>Enter <strong>stylist_name</strong></li><li>Click create stylist button</li></ol> | <ul><li>Display Message No Clients Found</li><li>Display <strong>stylist_name</strong> under Stylists section</li><li>Display option to add stylist</li><li>Display option to add client with stylist selection dropdown</li><li>Display Delete All button</li></ul> |
|                            |                       |                          |
| **Add client** | <ol><li>Enter <strong>client_name</strong></li><li>Select <strong>stylist_name</strong> from dropdown menu</li><li>Click create client button</li></ol> | <ul><li>Display <strong>client_name</strong> under Clients section</li><li>Display <strong>stylist_name</strong> under Stylists section</li><li>Display option to add stylist</li><li>Display option to add client with stylist selection dropdown</li><li>Display Delete All button</li></ul> |
|                            |                       |                          |
| **View stylist details** | <ol><li>Click on <strong>stylist_name</strong> link</li></ol> | <ul><li>Display <strong>stylist_name</strong></li><li>Display all clients belonging to <strong>stylist_name</strong> as links</li><li>Display option to delete stylist</li><li>Display option to update stylist</li></ul> |
|                            |                       |                          |
| **View client details** | <ol><li>Click on <strong>client_name</strong> link</li></ol> | <ul><li>Display <strong>client_name</strong></li><li>Display <strong>client_name</strong>'s unique stylist as link</li><li>Display option to delete client</li><li>Display option to update client</li></ul> |
|                            |                       |                          |
| **Update stylist name** | <ol><li>Click on <strong>stylist_name</strong> link</li><li>Click on update stylist button</li><li>Enter <strong>stylist_new_name</strong></li><li>Click submit button</li></ol> | <ul><li>Display <strong>stylist_new_name</strong></li><li>Display updated stylist information when viewing <strong>client_name</strong> details</li></ul> |
|                            |                       |                          |
| **Update client name** | <ol><li>Click on <strong>client_name</strong> link</li><li>Click on update client button</li><li>Enter <strong>client_new_name</strong></li><li>Click submit button</li></ol> | <ul><li>Display <strong>client_new_name</strong></li><li>Display updated client information when viewing <strong>stylist_new_name</strong> details</li></ul> |
|                            |                       |
| **Add second stylist** | <ol><li>Enter <strong>second_stylist_name</strong></li><li>Click create stylist button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>stylist_new_name</strong> under Stylists section</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li></ul> |                          |
|                            |                       |                          |
| **Update client's stylist** | <ol><li>Click on <strong>client_new_name</strong> link</li><li>Click on update client button</li><li>Select <strong>second_stylist_name</strong> from dropdown</li><li>Click submit button</li></ol> | <ul><li>Display second_stylist_name in <strong>client_new_name</strong> details</li><li>Display <strong>client_new_name</strong> when viewing <strong>second_stylist_name</strong> details</li><li>Display no clients when viewing <strong>stylist_new_name</strong> details</li></ul> |
|                            |                       |                          |
| **Add second client** | <ol><li>Enter <strong>second_client_name</strong></li><li>Select <strong>stylist_new_name</strong> from dropdown menu</li><li>Click create client button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display <strong>stylist_new_name</strong> under Stylists section</li><li>Display <strong>second_client_name</strong> in <strong>stylist_new_name</strong> details</li><li>Display <strong>client_new_name</strong> in <strong>second_stylist_name</strong> details</li></ul> |
|                            |                       |                          |
| **Delete stylist** | <ol><li>Click <strong>stylist_new_name</strong> link</li><li>Click delete stylist button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display <strong>UNASSIGNED</strong> under Stylists section</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li><li>Display <strong>client_new_name</strong> in <strong>second_stylist_name</strong> details</li><li>Display <strong>second_client_name</strong> in <strong>UNASSIGNED</strong> details</li><li>Display <strong>second_stylist_name</strong> in <strong>client_new_name</strong> details</li><li>Display <strong>UNASSIGNED</strong> in <strong>second_client_name</strong> details</li></ul> |
|                            |                       |                          |
| **Reassign unassigned client** | <ol><li>Click <strong>second_client_name</strong> link</li><li>Click update client button</li><li>Select <strong>second_stylist_name</strong> from dropdown menu</li><li>Click submit button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li><li>Display <strong>client_new_name</strong> in <strong>second_stylist_name</strong> details</li><li>Display <strong>second_client_name</strong> in <strong>second_stylist_name</strong> details</li><li>Display <strong>second_stylist_name</strong> in <strong>client_new_name</strong> details</li><li>Display <strong>second_stylist_name</strong> in <strong>second_client_name</strong> details</li></ul> |
|                            |                       |                          |
| **Search stylist** | <ol><li>Enter <strong>second_stylist_name</strong> in search bar</li><li>Press enter or click search button</li></ol> | <ul><li>Display Message No Clients Found</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li></ul> |
|                            |                       |                          |
| **Search client** | <ol><li>Enter <strong>second_client_name</strong> in search bar</li><li>Press enter or click search button</li></ol> | <ul><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display Message No Stylists Found</li></ul> |
|                            |                       |                          |
| **Search non-existant entity** | <ol><li>Enter <strong>non-existant</strong> in search bar</li><li>Press enter or click search button</li></ol> | <ul><li>Display Message No Clients Found</li><li>Display Message No Stylists Found</li></ul> |
|                            |                       |                          |
| **Empty search** | <ol><li>Press enter in search bar or click search button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li></ul> |
|                            |                       |                          |
| **Add client without choosing stylist** | <ol><li>Enter <strong>invalid_client</strong>in add client input</li><li>Click create client button</li></ol> | <ul><li>Display <strong>client_new_name</strong> under Clients section</li><li>Display <strong>second_client_name</strong> under Clients section</li><li>Display <strong>second_stylist_name</strong> under Stylists section</li></ul> |
|                            |                       |                          |
| **Delete all** | <ol><li>Click delete all button</li></ol> | <ul><li>Display Message No Clients Found</li><li>Display Message No Stylists Found</li><li>Option to add client disappears</li><li>Searching for deleted entities does not return results</li></ul> |


</br>
</br>

---
### **Setup/Installation Requirements ( * Nix)** :checkered_flag:

_If you wish to view the site locally on your machine please follow the following steps:_

#####  1). Navigate to the directory in which you want the hairSalon project to reside.

</br>

#####  2). Enter the following command into your terminal:

```
git clone https://github.com/KomodoTech/hairSalon.git
```

</br>

#####  3). Navigate to the hairSalon directory, and execute the following command in the terminal:

```
composer install
```

</br>

#####  4). To replicate the production database used by this app, use your preferred server stack (e.g. MAMP, LAMP, etc.) to launch a mysql server.

 >#### :exclamation: _NOTE_:
 >The database configuration in the php files will need to match your setup. The default is set to port localhost:8889, username:root, password:root


</br>
</br>

#####  5). Once you have your mysql server properly setup, run the following commands in your mysql shell:

```
CREATE DATABASE hair_salon;
CREATE DATABASE hair_salon_test;
```

</br>

#####  6). To replicate the settings used for these databases either navigate to the local phpMyAdmin page and import the _hair_salon.sql.zip_ file which resides inside the databases directory, or execute the following commands in your mysql shell:

```
USE hair_salon_test;
CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);
USE hair_salon;
CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), sylist_id INT);
```

</br>

#####  7). Navigate to the web directory and start your local host by executing the following command in your terminal:

```
php -S localhost:8000
```

</br>

#####  8). Open up the browser of your choice and go to the following url:

http://localhost:8000/

</br>

#####  9). To run tests from the root project directory execute the following command in the terminal:

```
vendor/phpunit/phpunit/phpunit
```

</br>

#####  10). If you wish to look at the source code, feel free to browse through the files in the hairSalon directory

</br>
</br>

---
### **Todo** :construction:
- [ ] Implement full substring search
- [ ] Write functional tests
- [x] Update README.md

</br>

---
### **Known Bugs** :bug:
None

---
### **Support and contact details** :email:

For comments or questions, please email alexandre.leibler@gmail.com

---
### **Technologies Used** :nut_and_bolt:

* silex v~2.0
* twig v~1.0
* phpunit v5.5.*
* bootstrap v3.3.7
* symphony v3.2

---
### **License** :hammer:

GPL-3.0

---
hairSalon Copyright (c) 2016 **Alexandre Leibler**
