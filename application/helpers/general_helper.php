<?php
/**
 *
 * @param int $value
 */
function getAsCash( $value, $showSymbol = true ){
	$value=doubleval($value);//make sure it is a double
	//see http://us3.php.net/manual/en/function.money-format.php
	setlocale(LC_MONETARY, 'en_US');
	if($showSymbol){
	   $currency=money_format("%#3n", $value);
	}else{
		$currency = number_format($value, 2);
	}
	return $currency;
}


/*
 * @params $table varchar table name
 * @params $data array consisting of "where" string or array, and "select" comma-delimited string
 * @returns an array of key-value pairs reflecting a Database primary key and human-meaningful string
 */
function getKeyedPair($list,$pairs, $options = array()){
	$output = array();
	$other = FALSE;
	if(!empty($options)){
		if(array_key_exists("other", $options)){
			$other = TRUE;
		}
		if(array_key_exists("initial_blank", $options)){
			$output[0] = "";
		}
	}
	foreach($list as $item){
		$key_name = $pairs[0];
		$key_value = $pairs[1];
		$output[$item->$key_name] = $item->$key_value;
	}
	
	if($other){
		$output["other"] = "Other...";
	}

	return $output;

}


/*
 * @function formatDate
 * @params $date date string
 * @params $format string
 * @abstract this shouldn't be in this file, but I didn't want to create a new file with general formatting tools yet.
 */
function formatDate($date,$format){
	//$format=mysql//yyyy-mm-dd
	//$format=standard//mm-dd-yyyy
	$date=str_replace("/","-",$date);
	switch($format){
		case "mysql":
			$parts=explode("-",$date);
			$month=$parts[0];
			$day=$parts[1];
			$year=$parts[2];
			$date="$year-$month-$day";
			break;
		case "standard":
			$parts=explode("-",$date);
			$year=$parts[0];
			$month=$parts[1];
			$day=$parts[2];
			$date="$month-$day-$year";
			break;
		default:
			$date=$date;
	}
	return $date;
}

/**
 * create a button with an image associated with it.
 * @param unknown_type $src
 * @param unknown_type $data
 */
function createButton($src,$data=null){
    $properties="";
    if($data!=null){
    	$keys = array_keys($data);
    	$values = array_values($data);
    	for($i=0;$i<count($data);$i++){
    		$name = $keys[$i];
    		$value = $values[$i];
    		$output[] = "$name='$value'";
    	}
       
        $properties=join(" ",$output);
    }

    $button="<img src=$src $properties/>";
    return $button;
}

function getValue($object, $item, $default = false){
    $output = $default;

    if($object){

        $var_list = get_object_vars($object);
        $var_keys = array_keys($var_list);
        if ( in_array($item, $var_keys) ){
            $output = $object->$item;
        }
    }
    return $output;
}