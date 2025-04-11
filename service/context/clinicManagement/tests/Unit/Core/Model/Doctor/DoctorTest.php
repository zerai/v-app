<?php declare(strict_types=1);

namespace ClinicManagementTests\Core\Model\Doctor;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ClinicManagement\Core\Model\Doctor\Doctor
 */
class DoctorTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function should_create_a_doctor(): void
    {
        self::expectNotToPerformAssertions();

        $doctorId = DoctorId::fromString(self::UUID);
        $name = 'irrelevant';
        $creationTime = new DateTimeImmutable('now');

        $doctor = new Doctor($doctorId, $name, $creationTime);
    }
}
