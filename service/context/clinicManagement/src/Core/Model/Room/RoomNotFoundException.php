<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room;

class RoomNotFoundException extends \Exception
{
    public static function withId(RoomId $id): self
    {
        return new self(\sprintf('Room with ID %s not found', $id->__toString()));
    }
}
