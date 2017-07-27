<?php
  $months = array(
	"jan",
	"feb",
	"mar",
	"apr",
	"may",
	"jun",
	"jul",
	"aug",
	"sep",
	"oct",
	"nov",
	"dec",
  );
  function sanitize($input){
    $input = filter_input(INPUT_GET, $input, FILTER_SANITIZE_STRING);
	$input = trim($input);
    return $input;
  }
  
  function properNormalDate($dateArr){
	global $months;
	$properDate = true;
	$lowerCaseData = strtolower(substr($dateArr[0], 0, 3));
	$monthIsCorrect = in_array($lowerCaseData, $months);
	if(!$monthIsCorrect){
		$properDate = false;
	}
	if($dateArr[1] > 31 || $dateArr[1] < 0){
		$properDate = false;
	}
	return $properDate;
  }
  
  function properUnixDate($dateArr){
	  
  }
  
  function processData($data){
	$data = str_replace(",", "", $data);
	$dataArr = explode(" ", $data, 5);
	$firstLetter = ctype_alpha(substr($data, 0, 1));
    if($firstLetter){
		if(!properNormalDate($dataArr)){
			$normalDate = null;
			$unixDate = null;
		}
		else{
			$normalDate = $data;
			$unixDate = strtotime($data);
		}
		$data = array(
			"normal" => $normalDate,
			"unix" => $unixDate,
		);
	}
	else{
		if($data > 2147483647){
			$data = array(
				"normal" => null,
				"unix" => null,
			);
		}
		else{
			$data = array(
				"normal" => date("M d, Y",$data),
				"unix" => $data,
			);
		}
	}
	$data = json_encode($data);
	return $data;
  }
  $input = sanitize('data');
  $result = processData($input);
  echo $result;
  exit();
echo <<<HTML
	<html>
	<body>
	<p>
		$result
	</p>
	</body>
	</html>
HTML;
?>