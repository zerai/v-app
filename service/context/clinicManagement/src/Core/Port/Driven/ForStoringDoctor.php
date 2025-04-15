<?php declare(strict_types=1);

namespace ClinicManagement\Core\Port\Driven;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;

interface ForStoringDoctor
{
    public function save(Doctor $doctor): void;

    /**
     * @throw DoctorNotFoundException
     */
    public function remove(DoctorId $doctorId): void;
}
