<?php declare(strict_types=1);

namespace ClinicManagementTests\Support\Factory;

use ClinicManagement\Core\Model\Room\Room;
use ClinicManagement\Core\Model\Room\RoomId;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Room>
 */
final class RoomFactory extends PersistentProxyObjectFactory
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
        return Room::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'id' => RoomId::generate(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'name' => 'Room' . self::faker()->colorName(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            ->instantiateWith(function (array $attributes) {
                $room = new Room($attributes['id'], $attributes['name'], $attributes['createdAt']);
                return $room; // custom instantiation for this factory
            })
            // ->afterInstantiate(function(Room $room): void {})
        ;
    }
}
