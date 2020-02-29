<?php

namespace App\Services\UserService\CreateUser\ValueObjects;


class CreateUserValueObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $mobile;
    /**
     * @var string
     */
    protected $Image;


    /**
     * @var string
     */
    protected $password;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CreateUserValueObject
     */
    public function setName(string $name): CreateUserValueObject
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CreateUserValueObject
     */
    public function setEmail(string $email): CreateUserValueObject
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return CreateUserValueObject
     */
    public function setPassword(string $password): CreateUserValueObject
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile): CreateUserValueObject
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->Image;
    }

    /**
     * @param string $Image
     */
    public function setImage(string $Image): CreateUserValueObject
    {
        $this->Image = $Image;
        return $this;

    }

}
