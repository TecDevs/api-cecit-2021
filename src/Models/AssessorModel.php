<?php

namespace App\Models;

class AssessorModel
{
    public int $assessorId;
    public string $name;
    public string $firstLastName;
    public string $secondLastName;
    public string $address;
    public string $suburb;
    public string $postalCode;
    public string $curp;
    public string $rfc;
    public string $phone;
    public string $email;
    public string $city;
    public string $locality;
    public string $school;
    public string $facebook;
    public string $twitter;
    public string $description;
    public $ineImage;
    public string $ineImageUrl;

    public function __construct(array $assessorParams)
    {
        $this->assessorId = $assessorParams['assessor_id'] ?? 0;
        $this->name = $assessorParams['adviser_name'] ?? '';
        $this->firstLastName = $assessorParams['last_name'] ?? '';
        $this->secondLastName = $assessorParams['second_last_name'] ?? '';
        $this->address = $assessorParams['address'] ?? '';
        $this->suburb = $assessorParams['suburb'] ?? '';
        $this->postalCode = $assessorParams['postal_code'] ?? '';
        $this->curp = $assessorParams['curp'] ?? '';
        $this->rfc = $assessorParams['rfc'] ?? '';
        $this->phone = $assessorParams['phone_contact'] ?? '';
        $this->email = $assessorParams['email'] ?? '';
        $this->city = $assessorParams['city'] ?? '';
        $this->locality = $assessorParams['locality'] ?? '';
        $this->school = $assessorParams['school_institute'] ?? '';
        $this->facebook = $assessorParams['facebook'] ?? '';
        $this->twitter = $assessorParams['twitter'] ?? '';
        $this->description = $assessorParams['participation_description'] ?? '';
        $this->ineImage = $assessorParams['image_ine'] ?? '';
        $this->ineImageUrl = $assessorParams['image_ine_url'] ?? '';
    }
}
