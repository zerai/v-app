<?php declare(strict_types=1);

namespace ClinicManagementTests\Integration\DomainRegression;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;
use ClinicManagement\Core\Model\Room\RoomNotFoundException;
use ClinicManagement\Core\Model\Room\Usecase\DeleteRoom\DeleteRoom;
use ClinicManagement\Core\Model\Room\Usecase\DeleteRoom\DeleteRoomHandler;
use ClinicManagementTests\Support\Factory\RoomFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use function PHPUnit\Framework\assertNull;

class DeleteRoomHandlerTest extends KernelTestCase
{
    use Factories;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var DeleteRoomHandler
     */
    private $usecase;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->entityManager = $container->get('doctrine')->getManager();
        $this->usecase = $container->get(DeleteRoomHandler::class);
    }

    public function test_delete_a_room(): void
    {
        $existingRoom = RoomFactory::createOne();
        $roomId = $existingRoom->getId();

        $command = new DeleteRoom($roomId);
        $this->usecase->__invoke($command);

        $repository = $this->entityManager
            ->getRepository(Room::class);
        $roomFromDB = $repository->findOneBy([
            'id' => $roomId,
        ]);
        assertNull($roomFromDB);
    }

    public function test_delete_a_room_throw_error_if_room_not_exist(): void
    {
        $this->expectException(RoomNotFoundException::class);

        $randomRoomId = RoomId::generate();
        $command = new DeleteRoom($randomRoomId);

        $this->usecase->__invoke($command);
    }

    public function test_delete_a_room_throw_error_with_message_if_room_not_exist(): void
    {
        $randomRoomId = RoomId::generate();
        $this->expectExceptionMessage(\sprintf('Room with ID %s not found', $randomRoomId->__toString()));

        $command = new DeleteRoom($randomRoomId);
        $this->usecase->__invoke($command);
    }
}
