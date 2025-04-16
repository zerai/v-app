<?php declare(strict_types=1);

namespace ClinicManagementTests\Unit\Core\Model\Room;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @covers \ClinicManagement\Core\Model\Room\Room
 */
class RoomTest extends TestCase
{
    private const UUID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function should_create_a_doctor(): void
    {
        self::expectNotToPerformAssertions();

        $roomId = RoomId::fromString(self::UUID);
        $name = 'irrelevant';
        $creationTime = new DateTimeImmutable('now');

        $room = new Room($roomId, $name, $creationTime);
    }
}
