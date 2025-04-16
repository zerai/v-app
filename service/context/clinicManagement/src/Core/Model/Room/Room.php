<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Room;

use ClinicManagement\Infrastructure\Doctrine\Type\RoomIdType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table('cm_room')]
class Room
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: RoomIdType::NAME, unique: true)]
        #[ORM\GeneratedValue(strategy: 'NONE')]
        private RoomId $id,
        #[ORM\Column(length: 180)]
        private string $name,
        #[ORM\Column(type: Types::DATETIME_IMMUTABLE, precision: 6)]
        private \DateTimeImmutable $createdAt
    ) {
    }

    public function getId(): RoomId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
