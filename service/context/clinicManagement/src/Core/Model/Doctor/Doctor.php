<?php declare(strict_types=1);

namespace ClinicManagement\Core\Model\Doctor;

use ClinicManagement\Infrastructure\Doctrine\Type\DoctorIdType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table('cm_doctor')]
class Doctor
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: DoctorIdType::NAME, unique: true)]
        #[ORM\GeneratedValue(strategy: 'NONE')]
        private DoctorId $id,
        #[ORM\Column(length: 180)]
        private string $name,
        #[ORM\Column(type: Types::DATETIME_IMMUTABLE, precision: 6)]
        private \DateTimeImmutable $createdAt
    ) {
    }

    public function getId(): DoctorId
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
