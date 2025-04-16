<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room\Usecase\DeleteRoom;

use ClinicManagement\Core\Model\Room\RoomId;

class DeleteRoom
{
    public function __construct(
        public readonly RoomId $roomId,
    ) {
    }
}
