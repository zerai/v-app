<?php declare(strict_types=1);

namespace ClinicManagement\AdapterForStoringDoctor;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use ClinicManagement\Core\Model\Doctor\DoctorNotFoundException;
use ClinicManagement\Core\Port\Driven\ForStoringDoctor;
use ClinicManagement\Infrastructure\Doctrine\Lib\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomDoctrineAdapterForStoringDoctor extends DoctrineRepository implements ForStoringDoctor
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class, 'doctor');
    }

    public function save(Doctor $doctor): void
    {
        $this->em->persist($doctor);
        $this->em->flush();
    }

    /**
     * @throw DoctorNotFoundException
     */
    public function remove(DoctorId $doctorId): void
    {
        if (null === $doctor = $this->em->find(Doctor::class, $doctorId)) {
            throw DoctorNotFoundException::withId($doctorId);
        }
        $this->em->remove($doctor);
        $this->em->flush();
    }

    public function ofId(DoctorId $doctorId): ?Doctor
    {
        return $this->em->find(Doctor::class, $doctorId);
    }
}
