<?php declare(strict_types=1);

namespace ClinicManagementTests\Support\Factory;

use ClinicManagement\Core\Model\Doctor\Doctor;
use ClinicManagement\Core\Model\Doctor\DoctorId;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Doctor>
 */
final class DoctorFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Doctor::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'id' => DoctorId::generate(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'name' => self::faker()->name(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            ->instantiateWith(function (array $attributes) {
                $doctor = new Doctor($attributes['id'], $attributes['name'], $attributes['createdAt']);
                return $doctor; // custom instantiation for this factory
            })
            // ->afterInstantiate(function(Doctor $doctor): void {})
        ;
    }
}
