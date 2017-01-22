# Project 1 - Globitek CMS

Time spent: **X** hours spent in total

## User Stories

The following **required** functionality is completed:

1. [x]  Required: Create a Users Table.

2. [x]  Required: Create a Page with an HTML Form in public folder.
  * [x]  Required: The page should be called "register.php".
  * [x]  Required: submits to: itself ("public/register.php").
 
3. [x]  Required:  Detect when the form is submitted.
  * [x] Required: If "/public/register.php" is loaded directly, it should display the form.
  * [x] Required: If the form was submitted, it should retrieve the form data.

4. [x]  Required: Validate form data.
  * [x] Required: Validate the presence of all form values.
  * [x] Required: Validate that no values are longer than 255 characters.
  * [x] Required: Validate that first_name and last_name have at least 2 characters.
  * [x] Required: Validate that username has at least 8 characters. 
  * [x] Required: Validate that email contains a "@".

5. [x]  Required: Display form errors if any validations fail.

6. [x] Required: Submit successfully-validated form values to the database.

7. [x] Required: Redirect the user to a confirmation page "public/registration_success.php".

8. [x] Required: Sanitize all dynamic output for HTML.

The following advanced user stories are optional:

* [x]  Bonus: Validate that form values contain only whitelisted characters

* [x]  Bonus: Validate the uniqueness of the username

## Video Walkthrough

Here's a walkthrough of implemented user stories:

<img src='https://github.com/t17711/web_security_Globitek_CMS/raw/master/walkthrough.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

Describe any challenges encountered while building the app.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
