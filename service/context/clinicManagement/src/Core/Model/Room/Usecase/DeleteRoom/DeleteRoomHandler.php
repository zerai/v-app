<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room\Usecase\DeleteRoom;

use ClinicManagement\Core\Port\Driven\ForStoringRoom;
use Exception;

class DeleteRoomHandler
{
    public function __construct(
        private readonly ForStoringRoom $repository,
    ) {

    }

    public function __invoke(DeleteRoom $command): void
    {
        try {
            $this->repository->remove($command->roomId);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
