#**From v3.73.3 this has been removed**

The password class uses php 5 password_ functions.

To create a hash of a password, call the make method and provide the password to be hashed, once done save the $hash.

```php
$hash = Password::make($password);
```

When logging in a user their hash must be retrieved from the database and compared against the provided password to make sure they match, for this a method called password_verify is used, it has 2 parameters the first is the user provided password the second is the hash from the database.

```php
if (Password::verify($_POST['password'], $data[0]->password)) {
     //passed
} else {
     //failed
}
```

From time to time you may update your hashing parameters (algorithm, cost, etc). So a function to determine if rehashing is necessary is available:

```php
if (Password::verify($password, $hash)) {     
   if (Password::needsRehash($hash, $algorithm, $options)) {         
       $hash = Password::make($password, $algorithm, $options); /* Store new hash in db */     
   } 
}
```
