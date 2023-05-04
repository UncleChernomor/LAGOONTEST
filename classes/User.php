<?php
class User
{
    private int $id = 0;
    private string $name = '';
    private string $email = '';
    private string $password = '';

    public static int $lastID = 0;
    public function __construct($name, $email, $password)
    {
        $this->id = ++self::$lastID;
        $this->name =  $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setID( $id ): void
    {
        $this->id = $id;
    }
    public function getID(): int
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
}