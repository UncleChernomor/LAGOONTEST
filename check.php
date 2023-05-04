<?php
error_reporting(E_ALL);

require_once 'classes/ValidateForm.php';
require_once 'classes/User.php';
require_once 'functiions.php';

$data = createData();

$firstName = '';
$secondName = '';
$email = '';
$password = '';
$passwordRe = '';

try{
    if ( isset($_POST['first-name']) ) {
        $firstName = htmlspecialchars( trim( $_POST['first-name'] ) );
        ValidateForm::checkText($firstName);
    }

    if ( isset($_POST['second-name']) ) {
        $secondName = htmlspecialchars( trim( $_POST['second-name'] ) );
        ValidateForm::checkText($secondName);
    }

    if ( isset($_POST['email']) ) {
        $email = htmlspecialchars( trim( $_POST['email'] ) );
        ValidateForm::checkEmail($email);
    }

    if ( isset($_POST['p0']) && isset($_POST['p1']) ) {
        $password = htmlspecialchars( trim( $_POST['p0'] ) );
        $passwordRe = htmlspecialchars( trim( $_POST['p1'] ) );
        ValidateForm::checkPassword($password, $passwordRe);
    }

    $user = findUser($data, $email);
    $messageForLog = '';
    $messageForFront = '';

    if ($user === null )    {

        $newUser = new User(
            $firstName . " " . $secondName,
            $email,
            $password
        );

        $data[] = $newUser;
        $messageForLog = "Create new user " . $newUser->getName();
        $messageForFront = $newUser->getName();
    } else {

        if( checkUserPassword($data, $user, $password) === true ) {
            $messageForLog = "User " . $user->getName() . " entered in application";
            $messageForFront = $user->getName();
        } else {
            $messageForLog = "The existing user " . $user->getName(). " has entered an invalid password";
            saveInLog($messageForLog);
            throw new Exception("Invalid password", 4);
        }
    }

    saveInLog($messageForLog);

    echo json_encode([
        'success' => 1,
        'info' => 'Welcome ' . $messageForFront,
    ]);

}catch (Exception $err) {
    echo json_encode([
        'success' => 0,
        'error' => $err->getMessage(),
    ]);
}