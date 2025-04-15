<?php declare(strict_types=1);

namespace ClinicManagementTests\Integration\DomainRegression;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use ClinicManagement\Core\Model\Doctor\DoctorNotFoundException;
use ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor\DeleteDoctor;
use ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor\DeleteDoctorHandler;
use ClinicManagementTests\Support\Factory\DoctorFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use function PHPUnit\Framework\assertNull;

class DeleteDoctorHandlerTest extends KernelTestCase
{
    use Factories;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var DeleteDoctorHandler
     */
    private $usecase;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->entityManager = $container->get('doctrine')->getManager();
        $this->usecase = $container->get(DeleteDoctorHandler::class);
    }

    public function test_delete_a_doctor(): void
    {
        $existingDoctor = DoctorFactory::createOne();
        $doctorId = $existingDoctor->getId();

        $command = new DeleteDoctor($doctorId);
        $this->usecase->__invoke($command);

        $repository = $this->entityManager
            ->getRepository(Doctor::class);
        $doctorFromDB = $repository->findOneBy([
            'id' => $doctorId,
        ]);
        assertNull($doctorFromDB);
    }

    public function test_delete_a_doctor_throw_error_if_doctor_not_exist(): void
    {
        $this->expectException(DoctorNotFoundException::class);

        $randomDoctorId = DoctorId::generate();
        $command = new DeleteDoctor($randomDoctorId);

        $this->usecase->__invoke($command);
    }

    public function test_delete_a_doctor_throw_error_with_message_if_doctor_not_exist(): void
    {
        $randomDoctorId = DoctorId::generate();
        $this->expectExceptionMessage(\sprintf('Doctor with ID %s not found', $randomDoctorId->__toString()));

        $command = new DeleteDoctor($randomDoctorId);
        $this->usecase->__invoke($command);
    }
}
