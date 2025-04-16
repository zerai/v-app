<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room\Usecase\AddRoom;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Port\Driven\ForStoringRoom;
use Exception;
use Psr\Clock\ClockInterface;

class AddRoomHandler
{
    public function __construct(
        private readonly ForStoringRoom $repository,
        private readonly ClockInterface $clock,
    ) {

    }

    public function __invoke(AddRoom $command): void
    {
        // add name validation
        $name = $command->name;
        $roomId = $command->roomId;
        $createdAt = $this->clock->now();

        $room = new Room($roomId, $name, $createdAt);

        try {
            $this->repository->save($room);
        } catch (Exception $e) {
            throw $e;
        }

    }
}
