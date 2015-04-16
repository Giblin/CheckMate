<?php
namespace CheckMate;
class CheckMate{
	
	protected $required;
	protected $rules;
	protected $data;
	protected $errorMessage;
		
	public function __construct(array $postData, array $rules){ //array $submitted,
		foreach($rules as $field=>$requerments ){
			$fieldRules = explode("||",$requerments);
			if(	$fieldRules[0] == 'required'){
				$this->required[] = $field;	
			}
			if(isset($fieldRules[1]) && !empty($fieldRules[1])){
				$this->rules[$field] = explode("=",$fieldRules[1]);
			}
		}
		$this->data = $postData;
	}
	
	public function validate(){
		foreach($this->required as $requiredField){	
			if(!isset($this->data[$requiredField]) || empty($this->data[$requiredField])){
				$this->errorMessage[$requiredField] = ucfirst($requiredField)." is required";
			}
		}
		foreach($this->rules as $field => $check){
			if(!empty($this->data[$field])){
				if(isset($check[1]))
					$input_check = $this->$check[0]($this->data[$field],$check[1]);
				else
					$input_check = $this->$check[0]($this->data[$field]);
				if($input_check !== true){
					$this->errorMessage[$field] = $input_check;
				}
			}
		}
		
		if(empty($this->errorMessage))
			return true;
		else
			return $this->errorMessage;
	}
	
	private function email($email){
		if(!preg_match('/^[\w\.\-]{1,}@[a-zA-Z0-9\-\.]{1,}\.\w{2,3}$/',$email))
			return 'Email is invalid.';	
		else
			return true;
	}
	private function regex($field,$ex){
		if(!preg_match($ex,$field))
			return 'RegEx is invalid.';	
		else
			return true;
	}
	private function match($field,$match){
		if($field !== $match)
			return 'Strings don\'t match.';	
		else
			return true;
	}
	private function zip($field){
		if(!preg_match('/^\d{5}([\-]?\d{4})?$/',$field))
			return 'Zip Code is invalid.';
		else
			return true;
	}
	private function same_as($field,$same){
		if($field !== $this->data[$same])
			return 'Fields don\'t Match.';
		else
			return true;
	}
		
}
?>