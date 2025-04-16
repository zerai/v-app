<?php declare(strict_types=1);

namespace ClinicManagement\Core\Port\Driven;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;

interface ForStoringRoom
{
    public function save(Room $room): void;

    /**
     * @throw RoomNotFoundException
     */
    public function remove(RoomId $roomId): void;
}
