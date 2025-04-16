<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RoomId implements \Stringable
{
    private function __construct(
        private readonly UuidInterface $uuid
    ) {
    }

    public static function generate(): RoomId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): RoomId
    {
        return new self(Uuid::fromString($id));
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(RoomId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
