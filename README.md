#CheckMate
#This is a work in progress and is not ready for use.
A simple PHP form validation lib.

##Install
This lib is designed to be used with spl_autoload.  Just add the class to your lib folder and make sure that you register the extension .class.php.

Or you can include the file directly.

##Example use:
###First Set up your rules array.  You can leave out fields you don't want to validate.
The array is set up with the name of the field as the key and the validation as the value.
```
$rules = array(
'first_name'=>'required', //first_name is a required field
'zip'=>'required||zip', //zip is a required field and must match Zip code format xxxxx or xxxxx-xxxx
'email'=>'required||email', //email is a required field and must be a valid email
'validate_regex'=>'required||regex=/(2|4)/', //validate_regex is a required field and must the regex in this case a number between 2 and 4
'validate_string'=>'not-required||match=1234', // validate_string is not a required field but if supplied must match the string '1234'
'password'=>'not-required||same_as=re_enter_pass', // Not a Required Field but must match what was put in re_enter_pass
);
```
###Then build the validator passing in the form data and the rules.

```
$submitted = new CheckMate\CheckMate($_POST,$rules);
```

###Then we call validate. This will return TRUE if the form is valid or an array of errors.
```
$valid = $submitted->validate();
```

###Now we check $validate and return errors.

```
if($valid === true){
	//If its good process the submitted data	
	}
	else{
	//Display Errors.
}
```