<?php
function createData(): array
{
    $data = [];

    $data[] = new User('Jurgen Klopp', 'klopp@lfc', '12345');
    $data[] = new User('my name', 'my@email', 'mypassword');
    $data[] = new User('Virgil van Dijk', 'virgil@lfc', '12345');

    return $data;
}

function findUser($data, $email):?User
{
    foreach ($data as $user) {
        if ( $user->getEmail() === $email ) {
            return $user;
        }
    }

    return null;
}

function checkUserPassword($data, $current_user, $current_password):bool {

    foreach ($data as $user) {
        if ( ( $user->getID() === $current_user->getID() )
            && ($user->getPassword() === $current_password) ) {
            return true;
        }
    }

    return false;
}

function saveInLog($message) {
    $message .= PHP_EOL;
    $result = file_put_contents('access.log', $message, FILE_APPEND);
    //reaction if don't save message in the file
}
