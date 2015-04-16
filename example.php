<?php
spl_autoload_extensions(".class.php"); // comma-separated list
spl_autoload_register();

$rules = array(
	'first_name'=>'required', //Required Field
	'zip'=>'required||zip', //Required Field and must match Zip code format xxxxx or xxxxx-xxxx
	'email'=>'not-required||email', //Required Field and must be a valid email
	'validate_regex'=>'required||regex=/(2|4)/', //Required Field and must the regex in this case a number between 2 and 4
	'validate_string'=>'not-required||match=1234', // Not a Required Field but if supplied must match the string '1234'
	'password'=>'not-required||same_as=re_enter_pass', // Not a Required Field but must match what was put in re_enter_pass
);
$submitted = new CheckMate\CheckMate($_POST,$rules);
$valid = $submitted->validate();
if($valid === true){
	echo 'Process Submision';	
}
else{
	foreach($valid as $error){
		echo $error.'<br>';	
	}
}
?>