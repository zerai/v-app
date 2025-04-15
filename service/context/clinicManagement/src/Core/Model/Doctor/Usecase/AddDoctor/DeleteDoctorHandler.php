<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor;

use ClinicManagement\Core\Port\Driven\ForStoringDoctor;
use Exception;

class DeleteDoctorHandler
{
    public function __construct(
        private readonly ForStoringDoctor $repository,
    ) {

    }

    public function __invoke(DeleteDoctor $command): void
    {
        try {
            $this->repository->remove($command->doctorId);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
