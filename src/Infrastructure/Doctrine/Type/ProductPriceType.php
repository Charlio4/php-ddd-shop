<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Product\ProductPrice;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class ProductPriceType extends Type
{
    const NAME = 'productPrice';


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
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ProductPrice
    {
        if (null == $value || $value instanceof ProductPrice) {
            return $value;
        }

        return ProductPrice::fromNumber((float) $value);
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

        if ($value instanceof ProductPrice) {
            return $value->toFloat();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', ProductPrice::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
