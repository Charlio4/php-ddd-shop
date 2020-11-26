<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Cart\CartStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class CartStatusType extends Type
{
    const NAME = 'cartStatus';


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
        return sprintf('varchar(%d)', CartStatus::MAX_LENGTH);
    }

    /**
     * {@inheritdoc}
     * @throws /Throwable
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?CartStatus
    {
        if (null == $value || $value instanceof CartStatus) {
            return $value;
        }

        return CartStatus::fromStr($value);
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

        if ($value instanceof CartStatus) {
            return $value->toStr();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', CartStatus::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
