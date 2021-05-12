<?php

namespace App\Models;

class AuthorModel
{
    public int $authorId;
    public int $projectId;
    public string $name;
    public string $firstLastName;
    public string $secondLastName;
    public string $address;
    public string $suburb;
    public string $postalCode;
    public string $curp;
    public string $rfc;
    public string $phone;
    public string $username;
    public string $email;
    public string $password;
    public string $city;
    public string $locality;
    public string $school;
    public string $facebook;
    public string $twitter;

    public function __construct(array $authorParams)
    {
        $this->authorId = $authorParams['author_id'] ?? 0;
        $this->projectId = $authorParams['project_id'] ?? 0;
        $this->name = $authorParams['name_author'] ?? '';
        $this->firstLastName = $authorParams['last_name'] ?? '';
        $this->secondLastName = $authorParams['second_last_name'] ?? '';
        $this->address = $authorParams['address'] ?? '';
        $this->suburb = $authorParams['suburb'] ?? '';
        $this->postalCode = $authorParams['postal_code'] ?? '';
        $this->curp = $authorParams['curp'];
        $this->rfc = $authorParams['rfc'];
        $this->phone = $authorParams['phone_contact'];
        $this->username = $authorParams['user_name'] ?? '';
        $this->email = $authorParams['email'];
        $this->password = $authorParams['password'] ?? '';
        $this->city = $authorParams['city'];
        $this->locality = $authorParams['locality'];
        $this->school = $authorParams['school'];
        $this->facebook = $authorParams['facebook'] ?? '';
        $this->twitter = $authorParams['twitter'] ?? '';
    }
}
