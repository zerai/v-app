<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Doctor;

class DoctorNotFoundException extends \Exception
{
    public static function withId(DoctorId $id): self
    {
        return new self(\sprintf('Doctor with ID %s not found', $id->__toString()));
    }
}
