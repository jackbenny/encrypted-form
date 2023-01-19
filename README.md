# Encrypted form
This is a small project to send encrypted form data to a recipient.
The data is encrypted using the form recipient's PGP key.

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

