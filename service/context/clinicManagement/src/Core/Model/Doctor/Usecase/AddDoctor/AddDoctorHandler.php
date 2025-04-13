<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Port\Driven\ForStoringDoctor;
use Exception;
use Psr\Clock\ClockInterface;

class AddDoctorHandler
{
    public function __construct(
        private readonly ForStoringDoctor $repository,
        private readonly ClockInterface $clock,
    ) {

    }

    public function __invoke(AddDoctor $command): void
    {
        // add name validation
        $name = $command->name;
        $doctorId = $command->doctorId;
        $createdAt = $this->clock->now();

        $doctor = new Doctor($doctorId, $name, $createdAt);

        try {
            $this->repository->save($doctor);
        } catch (Exception $e) {
            throw $e;
        }

    }
}
