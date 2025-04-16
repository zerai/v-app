<?php declare(strict_types=1);

namespace ClinicManagementTests\Unit\Core\Model\Room;

use ClinicManagement\Core\Model\Room\RoomId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * @covers \ClinicManagement\Core\Model\Room\RoomId
 */
class RoomIdTest extends TestCase
{
    private const FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const SECOND_ID = 'cc97e157-a0fa-478a-8ade-5692bbaa08e0';

    private const COPY_OF_FIRST_ID = 'dc97e157-a0fa-478a-8ade-5692bbaa08e0';

    /**
     * @test
     */
    public function should_auto_generate_a_RoomId(): void
    {
        $roomId = RoomId::generate();

        self::assertNotEmpty($roomId->__toString());
    }

    /**
     * @test
     */
    public function should_creates_a_RoomId_from_string(): void
    {
        $roomId = RoomId::fromString(self::FIRST_ID);
        self::assertSame(self::FIRST_ID, $roomId->__toString());
        self::assertSame(self::FIRST_ID, $roomId->__toString());
    }

    /**
     * @test
     * @depends should_creates_a_RoomId_from_string
     */
    public function should_compare_RoomIds(): void
    {
        $first = RoomId::fromString(self::FIRST_ID);
        $second = RoomId::fromString(self::SECOND_ID);
        $third = RoomId::fromString(self::COPY_OF_FIRST_ID);

        self::assertFalse($first->equals($second));
        self::assertTrue($first->equals($third));
        self::assertFalse($second->equals($third));
    }

    /**
     * @test
     */
    public function should_fail_when_uuid_string_is_empty(): void
    {
        self::expectException(InvalidUuidStringException::class);

        RoomId::fromString('');
    }

    /**
     * @test
     * @dataProvider invalidUuidProvider
     */
    public function should_fail_when_uuid_string_is_invalid(string $inputValue): void
    {
        self::expectException(InvalidUuidStringException::class);

        RoomId::fromString($inputValue);
    }

    /**
     * @return array<array-key, array<string>>
     */
    public function invalidUuidProvider(): array
    {
        return [
            ['0'],
            ['100'],
            ['abc'],
            [''],
        ];
    }
}
