# Subscribe Module

My first Drupal 8 module

Workflow :

* Module provides a block that can be activate and displayed anywhere .
* The module allows any user to subscribe to ANY CONTENT TYPE

* On subscribing to a particular type, user is required  to  register  the email to send notification.

* Modules creates a database table to store  subscription emails and type subscribe to.

* On node creation, batch operation is fired and all users subscribed to the specific node type are sent  email.