<?php declare(strict_types=1);

namespace ClinicManagement\Core\Port\Driven;

use ClinicManagement\Core\Model\Doctor\Doctor;

interface ForStoringDoctor
{
    public function save(Doctor $doctor): void;
}
