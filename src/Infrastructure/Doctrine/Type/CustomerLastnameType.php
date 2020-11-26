<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Customer\CustomerLastname;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class CustomerLastnameType extends Type
{
    const NAME = 'customerLastname';


    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return static::NAME;
    }


    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return sprintf('varchar(%d)', CustomerLastname::MAX_LENGTH);
    }


    /**
     * {@inheritdoc}
     * @throws /Throwable
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?CustomerLastname
    {
        if (null == $value || $value instanceof CustomerLastname) {
            return $value;
        }

        return CustomerLastname::fromStr($value);
    }


    /**
     * {@inheritdoc}
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null == $value) {
            return null;
        }

        if ($value instanceof CustomerLastname) {
            return $value->toStr();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', CustomerLastname::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
