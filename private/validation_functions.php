<?php

  // is_blank('abcd')
  function is_blank($value='') {
    // TODO
	return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
	
	$length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  function match_to_array($name='',$reg=''){
      if(preg_match($reg,$name)){
          return true;
      }
      return false;
      
  }
?>
