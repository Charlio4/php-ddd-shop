<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type;

use Api\Domain\ValueObj\Product\ProductName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class ProductNameType extends Type
{
    const NAME = 'productName';


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
        return sprintf('varchar(%d)', ProductName::MAX_LENGTH);
    }


    /**
     * {@inheritdoc}
     * @throws /Throwable
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?ProductName
    {
        if (null == $value || $value instanceof ProductName) {
            return $value;
        }

        return ProductName::fromStr($value);
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

        if ($value instanceof ProductName) {
            return $value->toStr();
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', ProductName::class]);
    }


    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
