<?php
// Where GnuPG should store keys and other stuff.
// This directory must be writable by the Apache/NGINX process,
// but remember to keep it outside of the webroot.
putenv('GNUPGHOME=/home/apache/gnupg');

// The recipient email and a subject line
$recipient = "me@example.com";
$subject = "Encrypted form";

//The public PGP key of the recipient
$key = "-----BEGIN PGP PUBLIC KEY BLOCK-----
...
-----END PGP PUBLIC KEY BLOCK-----
";

// The fingerprint for the above key
$fingerprint = "...";


// The form data from the HTML form
$name = trim(stripslashes(htmlspecialchars($_POST['name'])));
$message = trim(stripslashes(htmlspecialchars($_POST['message'])));
$email = trim(stripslashes(htmlspecialchars($_POST['_replyto'])));

// Check that user has entered a name, an e-mail address and a message
if (empty($name))
{
	echo "No name provided; the message has not been sent\n";
	exit;
}

if (empty($email))
{
	echo "No email provided; the mssage has not been sent\n";
	exit;
}

if (empty($message))
{
	echo "No message provided; the message has not been sent\n";
	exit;
}


// Initialize GnuPG
$gpg = new gnupg();

// Import the recipient's key
$gpg->import($key);

// Add the key
$gpg->addencryptkey($fingerprint);

// Encryt the message 
$encrypted_message = $gpg->encrypt("Name: $name\nE-mail: $email\n\nMessage: $message");

$headers = "From: \"Contact form\" <$recipient>" . "\r\n" .
    "Reply-To: $email" . "\r\n" .
    "Content-Type: text/plain; charset=UTF-8" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

// Send the mail (this requires a fully working SMTP-server on the host)
mail($recipient, $subject, $encrypted_message, $headers);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Your message has been sent</title>
  </head>
  <body>
    <h1>Your message has been sent</h1>
    <p>
    Thank you for your message<br>
    <strong><i>Best regards, NNN</i></strong>
    </p>
  </body>
</html>

