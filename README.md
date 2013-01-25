mobilemanual: manual authentication plugin for Moodle Mobile applications
=========================================================================

This is a [Moodle](http://moodle.org) authentication plugin aimed at mobile 
applications. It is compatible with the Moodle 2.x branch.

Installation
------------

To install please proceed as follows:

1. Decompress the mobilemanual archive and move the rename the folder to mobilemanual.

   You also can use this command: git clone git://github.com/arael/Moodle_MobileManual_auth_plugin.git mobilemanual

2. Move the folder to MOODLEROOT/auth

3. Authenticate as administrator on your Moodle installation and click on Notifications.

4. Click on Ok and finish the installation

Once the installation is complete you should have a authentication plugin under
Settings-Plugins-Authentication-Manage Authentication named "Mobile Manual".

Usage
-----

The usage of this course should be a secure request structured as follows.

https://yourmoodleinstallation.ch/auth/mobilemanual/authenticate.php?username=myuser&password=mypassword

If the user has been authenticated the response will be:

{
	"3":{"coursename":"My first course","token":"caad14a34dc3582e1b0d9a83be6ae68b"},
	"2":{"coursename":"My second course","token":"8161fcd02e94ee73546dd6deb453a9e7"}
}

As you can see from the example for every course there will be an entry with id
as the key value and coursename and the token as fields. Every request creates 
the new tokens and deletes the old ones. The duration of the tokens and the 
association with the webservice is set in the plugin settings: 
Site Administration-Plugins-Authentication-Mobile Manual.
You may develop your own webservices set or use/extend the uniappws. In any 
case the correct functioning and the generation of the tokens requires a valid 
webservice association.
