<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Product\ProductQuantity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Throwable;

class ProductQuantityType extends Type
{
    const NAME = 'productQuantity';

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
        return 'integer';
    }


    /**
     * {@inheritdoc}
     * @throws Throwable
     * @return ProductQuantity|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ProductQuantity
    {
        return ProductQuantity::fromInt($value);
    }


    /**
     * {@inheritdoc}
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof ProductQuantity) {
            return $value->toInt();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', ProductQuantity::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
