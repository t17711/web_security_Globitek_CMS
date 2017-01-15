<?php
require_once('../private/initialize.php');

// the variables for this page
$inputs = ["first_name", "last_name", "email", "username"];
$input_tidy = ["First name", "Last name", "Email", "Username"];
$length = [['min'=>2, 'max'=>255], ['min'=>2, 'max'=>255],['min'=>0, 'max'=>255], ['min'=>8, 'max'=>255]];
$special_chars=['/\A[A-Za-z\s\-,\.\']+\Z/', 
                '/\A[A-Za-z\s\-,\.\']+\Z/', 
                 '/\A[A-Za-z0-9\_\.]+@[A-Za-z0-9\_\.]+\Z/',  
                    '/\A[A-Za-z0-9\_]+\Z/']; 
$special_desc=['letters, spaces, symbols: - , . \'', 
                'letters, spaces, symbols: - , . \'',
                    'letters, numbers, symbols: _@.',
                    'letters, numbers, symbols: _'];
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

   
    // read inputs
    $output_vals=array_map('filter_input',[INPUT_POST],$inputs);
    // check if any part is empty
   $filled = array_map("is_blank", $output_vals);

    for ($i = 0; $i < sizeof($inputs); $i++) {
        if ($filled[$i]) {
            $errors[] = h("The " . $input_tidy[$i] . " cannot be empty");
        } else {

            // now valudate inputs
            $outputs[$inputs[$i]] = ($output_vals[$i]);
            if (!has_length($outputs[$inputs[$i]], $length[$i])) {
                $errors[] = h("The " . $input_tidy[$i] . " has to be between " . $length[$i]['min'] .  " and " . $length[$i]['max'] . " length");
            }
            if (!match_to_array($outputs[$inputs[$i]], $special_chars[$i])) {
                $errors[] = h("The " . $input_tidy[$i] . " can only contain " . $special_desc[$i]);
            }
        }
    }
 
    if(sizeof($errors)>0){
        echo display_errors($errors); 
    }
    else{
        //enteer to db
        // db onnected on db function
  
        $stringified_output = [];
       
        foreach ($output_vals as $out){
           $stringified_output[]= db_escape($db,$out); 
        }
        $stringified_output[]= db_escape($db,date('Y-m-d H:i:s'));
        
        $sql = "insert into users  ".
                "(first_name, last_name, email, username, created_at)". 
                "values('" ;
       
        foreach($stringified_output as $o){
                $sql.=$o."','";
                
        }
        $sql = substr($sql,0,-2);
        $sql.= ")";
        //echo $sql;
        $state_result = db_query($db, $sql);
        if(!$state_result) {  
            $dup = 'Duplicate entry';
            $len = strlen($dup);
            $err = substr((mysqli_error($db)),0,$len);
            if($err==$dup){
                $errors[]=h("Username not available");
            }else{
             $errors[] = h("Something went wrong.Please try again");
            }
             echo display_errors($errors); 
        }
        else{
            redirect_to('registration_success.php');
            die();
        }
        
    }
} 

?>

 
    <!-- TODO: HTML form goes here -->
    <div id="input_area">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

            <div>
                First Name:
                <input type="text" name="first_name" value="<?php echo $outputs['first_name']; ?>" />
                 Last Name:
                <input type="text" name="last_name" value="<?php echo $outputs['last_name']; ?>" />
            </div>

            <hr />

            <div>
                Email: 
                <input type="text" name="email" value="<?php echo $outputs['email']; ?>" />
            </div>

            <hr />

            <div>
               Username:
                <input type="text" name="username" value="<?php echo $outputs['username'] ?>" />
            </div>

            <hr />

            <input type="submit" class="btn btn-info" value="Submit" />

        </form>
        <hr />


    </div>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
