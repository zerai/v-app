<?php declare(strict_types=1);

namespace ClinicManagement\AdapterForStoringRoom;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;
use ClinicManagement\Core\Model\Room\RoomNotFoundException;
use ClinicManagement\Core\Port\Driven\ForStoringRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Room>
 */
class DoctrineAdapterForStoringRoom extends ServiceEntityRepository implements ForStoringRoom
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function save(Room $room): void
    {
        $this->getEntityManager()->persist($room);
        $this->getEntityManager()->flush();
    }

    /**
     * @throw RoomNotFoundException
     */
    public function remove(RoomId $roomId): void
    {
        if (null === $room = $this->find($roomId)) {
            throw RoomNotFoundException::withId($roomId);
        }
        $this->getEntityManager()->remove($room);
        $this->getEntityManager()->flush();
    }
}
