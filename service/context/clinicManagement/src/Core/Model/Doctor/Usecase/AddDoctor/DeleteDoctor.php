<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor;

use ClinicManagement\Core\Model\Doctor\DoctorId;

class DeleteDoctor
{
    public function __construct(
        public readonly DoctorId $doctorId,
    ) {
    }
}
