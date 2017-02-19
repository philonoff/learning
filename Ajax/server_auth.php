<?php
session_start();
include "validator.php";

$response = array();

$formValidator = new Validator($_POST);
$formValidator->checkForm();

if ($formValidator->errorFlag) {
    $response['errors'] = $formValidator->errors;
}

echo json_encode($response);

?>