<?php
class ValidateForm
{
    /**
     * @throws Exception
     */
    public static function checkText($field)
    {
        if ( mb_strlen($field) < 5) {
            throw new Exception("Length string too little", 1);
        }
    }

    /**
     * @throws Exception
     */
    public static function checkEmail($field)
    {
        try {
            ValidateForm::checkText($field);

            $pattern_email = "/^[a-zA-Z0-9._-]{2,50}+@[a-zA-Z.]{2,50}$/";
            if ( !preg_match($pattern_email, $field) ) {
                throw new Exception("Wrong data in the email field", 2);
            }
        } catch (Exception $err)
        {
            throw new Exception("Incorrect email." . $err->getMessage(), 2);
        }
    }

    /**
     * @throws Exception
     */
    public static function checkPassword($field_original, $field_re)
    {
        try {
            if ( $field_original !== $field_re ) {
                throw new Exception('Passwords are different');
            }

            ValidateForm::checkText($field_original);

        } catch (Exception $err)
        {
            throw new Exception("Error in the password field. " . $err->getMessage(), 3);
        }
    }
}
