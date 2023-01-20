# Encrypted form
This is a small project to send encrypted form data to a recipient.
The data is encrypted using the form recipient's PGP key.

Please note that this only encrypts the email being sent from the webserver
to the recipient. You still need to protect the data being transmitted
between the browser and the server, for example with HTTPS.

## Requirements
Apache/NGINX with PHP and the GnuGP PHP module. The module is installed with 
`apt install php-gnupg` on Debian and Ubuntu systems.

The Apache/NGINX process also needs write permission to the GnuPG home
directory (set the GnuPG home directory in `contact.php`).

You also need to set the following variables in `contact.php`:

* `$recipient` (email of the form recipient)
* `$subject` (a subject line for the email)
* `$key` (the **public** PGP key of the recipient)
* `$fingerprint` (the fingerprint of the public PGP key)

