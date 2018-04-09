<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$firstNumber  = $json->result->parameters->firstNumber;
	$secondNumber = $json->result->parameters->secondNumber;
	$acction 	  = $json->result->action;
	
	switch ($acction) {
		case 'Add':
			$speech = "your answer is ".($firstNumber+$secondNumber);
			break;

		case 'Multiply':
			$speech = "your answer is ".($firstNumber*$secondNumber);
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>
