<?php declare(strict_types=1);

namespace ClinicManagement\AdapterForStoringDoctor;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use ClinicManagement\Core\Model\Doctor\DoctorNotFoundException;
use ClinicManagement\Core\Port\Driven\ForStoringDoctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Doctor>
 */
class DoctrineAdapterForStoringDoctor extends ServiceEntityRepository implements ForStoringDoctor
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function save(Doctor $doctor): void
    {
        $this->getEntityManager()->persist($doctor);
        $this->getEntityManager()->flush();
    }

    /**
     * @throw DoctorNotFoundException
     */
    public function remove(DoctorId $doctorId): void
    {
        if (null === $doctor = $this->find($doctorId)) {
            throw DoctorNotFoundException::withId($doctorId);
        }
        $this->getEntityManager()->remove($doctor);
        $this->getEntityManager()->flush();
    }
}
