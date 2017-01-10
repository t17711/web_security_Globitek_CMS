<?php
require_once('../private/initialize.php');

// the variables for this page
$inputs = ["first_name", "last_name", "email", "username"];
$input_tidy = ["First name", "Last name", "Email", "Username"];
$length = [[2, 255], [2, 255], [0, 255], [8, 255]];

$outputs = array();

foreach ($inputs as $temp) {
    $outputs[$temp] = '';
}

$errors = array();


// Set default values for all variables the page needs.
// if this is a POST request, process the form
// Hint: private/functions.php can help
// Confirm that POST values are present before accessing them.
// Perform Validations
// Hint: Write these in private/validation_functions.php
// if there were no errors, submit data to database
// Write SQL INSERT statement
// $sql = "";
// For INSERT statments, $result is just true/false
// $result = db_query($db, $sql);
// if($result) {
//   db_close($db);
//   TODO redirect user to success page
// } else {
//   // The SQL INSERT statement failed.
//   // Just show the error, not the form
//   echo db_error($db);
//   db_close($db);
//   exit;
// }
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
    <h1>Register</h1>
    <p>Register to become a Globitek Partner.</p>

<?php
// TODO: display any form errors here
// Hint: private/functions.php can help
// if this is post request do this
if (is_post_request()) {

    // check if any part is empty
    $filled = array_map("is_blank", $inputs);
    for ($i = 0; $i < sizeof($inputs); $i++) {
        if (!($filled[$i])) {
            $errors[] = "The " . $input_tidy[$i] . " cannot be empty";
        } else {

            // now valudate inputs
            $outputs[$inputs[$i]] = (filter_input(INPUT_POST, $inputs[$i]));

            if (!has_length($outputs[$inputs[$i]], $length[$i])) {
                $errors[] = "The " . $input_tidy[$i] .
                        " has to be between " . $length[$i][0] .
                        " and " . $length[$i][1] . " length";
            }
        }
    }

    // so no error so try to procdss
    // first check email
    if ($outputs[$inputs[3]] != '') {
        if (!has_valid_email_format($outputs[$inputs[3]])) {
            $errors[] = $outputs[$inputs[3]] . " is invalid email";
        }
    }
}



if(sizeof($errors)>0){
    echo display_errors($errors);
}
else{
    // add to db
    
}


//  echo display_errors($outputs);
?>

    <!-- TODO: HTML form goes here -->
    <div id="input_area">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

            <div class="input-group input-group-lg">
                <span class="input-group-addon">First Name: </span>
                <input class="form-control" type="text" name="first_name" value="<?php echo $outputs['first_name']; ?>" />
                <span class="input-group-addon">  Last Name: </span>
                <input class="form-control" type="text" name="last_name" value="<?php echo $outputs['last_name']; ?>" />
            </div>

            <hr />

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Email: </span>
                <input class="form-control" type="text" name="email" value="<?php echo $outputs['email']; ?>" />
            </div>

            <hr />

            <div class="input-group input-group-lg">
                <span class="input-group-addon">Username: </span>
                <input class="form-control" type="text" name="username" value="<?php echo $outputs['username'] ?>" />
            </div>

            <hr />

            <input type="submit" class="btn btn-info" value="Submit" />

        </form>
        <hr />


    </div>



</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
