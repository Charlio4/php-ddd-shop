<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Cart\CartAmount;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class CartAmountType extends Type
{
    const NAME = 'cartAmount';


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
        return 'decimal(10,2)';
    }


    /**
     * {@inheritdoc}
     * @throws /Throwable
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?CartAmount
    {
        if (null == $value || $value instanceof CartAmount) {
            return $value;
        }

        return CartAmount::fromNumber((float) $value);
    }


    /**
     * {@inheritdoc}
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?float
    {
        if (null == $value) {
            return null;
        }

        if ($value instanceof CartAmount) {
            return $value->toFloat();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', CartAmount::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
