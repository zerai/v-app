<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room\Usecase\AddRoom;

use ClinicManagement\Core\Model\Room\RoomId;

class AddRoom
{
    public function __construct(
        public readonly RoomId $roomId,
        public readonly string $name,
    ) {
    }
}
