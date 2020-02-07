# Subscribe Module

My first Drupal 8 module

Workflow :

* Module provides a block that can be activated and displayed anywhere .
* The module allows any user to subscribe to ANY CONTENT TYPE

* On subscribing to a particular type, user is required  to  register  the email to send notification.

* Modules creates a database table to store  subscription emails and content type subscribe to, including date subscribed.

* On content creation, batch operation is fired and all users subscribed to the specific node type are sent email.


#TODO
*Create a page where users can update/delete their email from subscriptions
*Move batch operation to background process