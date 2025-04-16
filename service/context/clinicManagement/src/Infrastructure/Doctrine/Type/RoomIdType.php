<?php declare(strict_types=1);

namespace ClinicManagement\Infrastructure\Doctrine\Type;

use ClinicManagement\Core\Model\Room\RoomId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Exception\ValueNotConvertible;
use Doctrine\DBAL\Types\GuidType;
use Throwable;
use function class_exists;
use function method_exists;

/**
 * Field type mapping for the Doctrine Database Abstraction Layer (DBAL).
 *
 * RoomId fields will be stored as a string in the database and converted back to
 * the RoomId value object when querying.
 */
class RoomIdType extends GuidType
{
    public const NAME = 'room_id';

    /**
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?RoomId
    {
        if ($value instanceof RoomId) {
            return $value;
        }

        if (! \is_string($value) || $value === '') {
            return null;
        }

        try {
            $roomId = RoomId::fromString($value);
        } catch (Throwable) {
            throw class_exists(ValueNotConvertible::class)
                ? ValueNotConvertible::new($value, self::NAME)
                : ConversionException::conversionFailed($value, self::NAME);
        }

        return $roomId;
    }

    /**
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (
            $value instanceof RoomId
            || (
                (\is_string($value)
                || (\is_object($value) && method_exists($value, '__toString')))
            )
        ) {
            return (string) $value;
        }

        throw class_exists(ValueNotConvertible::class)
            ? ValueNotConvertible::new($value, self::NAME)
            : ConversionException::conversionFailed($value, self::NAME);
    }

    /**
     * @deprecated this method is deprecated by doctrine and will be removed infuture
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @deprecated this method is deprecated by doctrine and will be removed future
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return [self::NAME];
    }
}
