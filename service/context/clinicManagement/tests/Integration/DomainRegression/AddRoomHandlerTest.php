<?php declare(strict_types=1);

namespace ClinicManagementTests\Integration\DomainRegression;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;
use ClinicManagement\Core\Model\Room\Usecase\AddRoom\AddRoom;
use ClinicManagement\Core\Model\Room\Usecase\AddRoom\AddRoomHandler;
use ClinicManagementTests\Support\Factory\RoomFactory;
use Doctrine\ORM\Exception\EntityIdentityCollisionException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotNull;

class AddRoomHandlerTest extends KernelTestCase
{
    use Factories;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var AddRoomHandler
     */
    private $usecase;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->entityManager = $container->get('doctrine')->getManager();
        $this->usecase = $container->get(AddRoomHandler::class);
    }

    public function test_add_a_room(): void
    {
        $faker = \Faker\Factory::create();
        $repository = $this->entityManager
            ->getRepository(Room::class);
        $uuid = Uuid::uuid4()->toString();

        $command = new AddRoom(RoomId::fromString($uuid), $faker->name());
        $this->usecase->__invoke($command);

        $roomFromDB = $repository->findOneBy([
            'id' => $uuid,
        ]);
        assertNotNull($roomFromDB);
        assertInstanceOf(Room::class, $roomFromDB);
    }

    public function test_add_a_room_throw_error_if_room_exist(): void
    {
        $this->expectException(EntityIdentityCollisionException::class);

        $existingRoom = RoomFactory::createOne();
        $existingUuid = $existingRoom->getId()->__toString();

        $command = new AddRoom(RoomId::fromString($existingUuid), 'irrelevant name');
        $this->usecase->__invoke($command);
    }
}
