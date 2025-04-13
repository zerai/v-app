<?php declare(strict_types=1);

namespace ClinicManagementTests\Integration\DomainRegression;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor\AddDoctor;
use ClinicManagement\Core\Model\Doctor\Usecase\AddDoctor\AddDoctorHandler;
use ClinicManagementTests\Support\Factory\DoctorFactory;
use Doctrine\ORM\Exception\EntityIdentityCollisionException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotNull;

class AddDoctorHandlerTest extends KernelTestCase
{
    use Factories;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var AddDoctorHandler
     */
    private $usecase;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->entityManager = $container->get('doctrine')->getManager();
        $this->usecase = $container->get(AddDoctorHandler::class);
    }

    public function test_add_a_doctor(): void
    {
        $faker = \Faker\Factory::create();
        $repository = $this->entityManager
            ->getRepository(Doctor::class);
        $uuid = Uuid::uuid4()->toString();

        $command = new AddDoctor(DoctorId::fromString($uuid), $faker->name());
        $this->usecase->__invoke($command);

        $doctorFromDB = $repository->findOneBy([
            'id' => $uuid,
        ]);
        assertNotNull($doctorFromDB);
        assertInstanceOf(Doctor::class, $doctorFromDB);
    }

    public function test_add_a_doctor_throw_error_if_doctor_exist(): void
    {
        $this->expectException(EntityIdentityCollisionException::class);

        $existingDoctor = DoctorFactory::createOne();
        $existingUuid = $existingDoctor->getId()->__toString();

        $command = new AddDoctor(DoctorId::fromString($existingUuid), 'irrelevant name');
        $this->usecase->__invoke($command);
    }
}
