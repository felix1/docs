# Input

**Please note that both Input and Request do NOT sanitize your data, it is up to you to do that.**

## Basic Input

You may access all user input with a few simple methods. You do not need to worry about the HTTP verb used for the request, as input is accessed in the same way for all verbs.

#### Retrieving An Input Value

{line-numbers=off}
~~~~~~~~
$name = Input::get('name');
~~~~~~~~

#### Retrieving A Default Value If The Input Value Is Absent

{line-numbers=off}
~~~~~~~~
$name = Input::get('name', 'Sally');
~~~~~~~~

#### Determining If An Input Value Is Present

{line-numbers=off}
~~~~~~~~
if (Input::has('name'))
{
    //
}
~~~~~~~~

#### Getting All Input For The Request

{line-numbers=off}
~~~~~~~~
$input = Input::all();
~~~~~~~~

#### Getting Only Some Of The Request Input

{line-numbers=off}
~~~~~~~~
$input = Input::only('username', 'password');

$input = Input::except('credit_card');
~~~~~~~~

When working on forms with "array" inputs, you may use dot notation to access the arrays:

{line-numbers=off}
~~~~~~~~
$input = Input::get('products.0.name');
~~~~~~~~

> Note: Some JavaScript libraries such as Backbone may send input to the application as JSON. You may access this data via Input::get like normal.

## Old Input

You may need to keep input from one request until the next request. For example, you may need to re-populate a form after checking it for validation errors.

#### Flashing Input To The Session

{line-numbers=off}
~~~~~~~~
Input::flash();
~~~~~~~~

#### Flashing Only Some Input To The Session

{line-numbers=off}
~~~~~~~~
Input::flashOnly('username', 'email');

Input::flashExcept('password');
~~~~~~~~

Since you often will want to flash input in association with a redirect to the previous page, you may easily chain input flashing onto a redirect.


{line-numbers=off}
~~~~~~~~
return Redirect::to('form')->withInput();

return Redirect::to('form')->withInput(Input::except('password'));
~~~~~~~~

> Note: You may flash other data across requests using the Session class.

#### Retrieving Old Data

{line-numbers=off}
~~~~~~~~
Input::old('username');
~~~~~~~~

## Files

#### Retrieving An Uploaded File

{line-numbers=off}
~~~~~~~~
$file = Input::file('photo');
~~~~~~~~

#### Determining If A File Was Uploaded

{line-numbers=off}
~~~~~~~~
if (Input::hasFile('photo'))
{
    //
}
~~~~~~~~

The object returned by the file method is an instance of the `Symfony\\Component\\HttpFoundation\\File\\UploadedFile` class, which extends the PHP `SplFileInfo` class and provides a variety of methods for interacting with the file.

#### Determining If An Uploaded File Is Valid

{line-numbers=off}
~~~~~~~~
if (Input::file('photo')->isValid())
{
    //
}
~~~~~~~~

#### Moving An Uploaded File

{line-numbers=off}
~~~~~~~~
Input::file('photo')->move($destinationPath);

Input::file('photo')->move($destinationPath, $fileName);
~~~~~~~~

#### Retrieving The Path To An Uploaded File

{line-numbers=off}
~~~~~~~~
$path = Input::file('photo')->getRealPath();
~~~~~~~~

#### Retrieving The Original Name Of An Uploaded File

{line-numbers=off}
~~~~~~~~
$name = Input::file('photo')->getClientOriginalName();
~~~~~~~~

#### Retrieving The Extension Of An Uploaded File

{line-numbers=off}
~~~~~~~~
$extension = Input::file('photo')->getClientOriginalExtension();
~~~~~~~~

#### Retrieving The Size Of An Uploaded File

{line-numbers=off}
~~~~~~~~
$size = Input::file('photo')->getSize();
~~~~~~~~

#### Retrieving The MIME Type Of An Uploaded File

{line-numbers=off}
~~~~~~~~
$mime = Input::file('photo')->getMimeType();
~~~~~~~~
