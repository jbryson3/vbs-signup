vbs-signup
==========

An app for signing up participants for Vacation Bible School that includes an admin control panel

##Getting Started

You'll need a PHP capable server as well as a database.  I have tested with MySQL, but I'm sure others would work just fine

1. Download this code repo from github
2. Use dbSchema.sql to create the participantlist table that the app will use, make note of the username and password used to access the db
3. Modify db.php to include the host, dbname (default 'vbs'), admin username and admin password. Don't forget to set the switched value to 0 for using the prodution db
4. Point your participants to the participantForm.html page

##Admin Control Panel

The app features an admin control panel. You can get there by going to {host}/admin/adminLogin.php
The default login for the control panel is admin/Admin01 it should be changed by following the instructions in adminLogin.php

###Menu.php
Once logged in as an admin, the menu.php page shows how many kids are currently signed up (in real time) as well as some additional actions you may take

  - __Generate participant spreadsheet__ - to get the entire list of current participants and all their information in an Excel format
  - __Print out individual forms__ - To print out a specific participants information in a one page format
  - __View/Edit Participants__ - A web interface to see who has signed up, edit, remove or add participants

&copy; 2010 John Bryson
