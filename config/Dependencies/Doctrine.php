<?php

declare(strict_types=1);

use Api\Domain\Common\WriteModelInterface;
use Api\Domain\ReadModel\CartRepositoryInterface;
use Api\Domain\ReadModel\ProductRepositoryInterface;
use Api\Domain\ReadModel\SellerRepositoryInterface;
use Api\Infrastructure\Doctrine\Model\WriteModel;
use Api\Infrastructure\Doctrine\Type\CartAmountType;
use Api\Infrastructure\Doctrine\Type\CartStatusType;
use Api\Infrastructure\Doctrine\Type\CreatedAtType;
use Api\Infrastructure\Doctrine\Type\CustomerFirstnameType;
use Api\Infrastructure\Doctrine\Type\CustomerLastnameType;
use Api\Infrastructure\Doctrine\Type\ProductNameType;
use Api\Infrastructure\Doctrine\Type\ProductPriceType;
use Api\Infrastructure\Doctrine\Type\ProductQuantityType;
use Api\Infrastructure\Doctrine\Type\SellerNameType;
use Api\Infrastructure\ReadModel\CartRepository;
use Api\Infrastructure\ReadModel\ProductRepository;
use Api\Infrastructure\ReadModel\SellerRepository;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Cache\RedisCache;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Ramsey\Uuid\Doctrine\UuidType;

// ORM

$container['EntityManager'] = function (ContainerInterface $c): EntityManagerInterface {
    $setting = $c['settings']['doctrine'];

    $config = Setup::createConfiguration($setting['dev_mode']);

    // Proxy
    $config->setAutoGenerateProxyClasses($setting['dev_mode']);
    $config->setProxyDir($setting['proxy_dir']);
    $config->setProxyNamespace('Api\Domain\Proxy');

    /*
     * Cache
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/caching.html
     */
    if ($setting['dev_mode']) {
        $cache = new FilesystemCache($setting['cache_dir']);
    } else {
        $cache = new RedisCache();
        $cache->setRedis($c['redis']);
    }

    $cache->setNamespace('shopapi:api:cache:doctrine:');

    // Cachea el mapeo de entidad con tabla, se realiza 1 vez, no crece
    $config->setMetadataCacheImpl($cache);

    // Cachea la conversion de DQL a SQL, se realiza 1 vez
    $config->setQueryCacheImpl($cache);

    /*
     * Cachea los resultados, solo cuando se implenta en la query expresamente:
     * $query->enableResultCache(3600, 'label_id');
     */
    $config->setResultCacheImpl($cache);

    // Mapping Types
    $config->setMetadataDriverImpl(new XmlDriver([$setting['metadata_dir']], '.orm.xml'));
    Type::addType(UuidType::NAME, UuidType::class);
    Type::addType(SellerNameType::NAME, SellerNameType::class);
    Type::addType(CreatedAtType::NAME, CreatedAtType::class);

    Type::addType(ProductNameType::NAME, ProductNameType::class);
    Type::addType(ProductPriceType::NAME, ProductPriceType::class);

    Type::addType(ProductQuantityType::NAME, ProductQuantityType::class);
    Type::addType(CartStatusType::NAME, CartStatusType::class);

    Type::addType(CustomerFirstnameType::NAME, CustomerFirstnameType::class);
    Type::addType(CustomerLastnameType::NAME, CustomerLastnameType::class);

    Type::addType(CartAmountType::NAME, CartAmountType::class);

    return EntityManager::create($setting['connection']['shopapi'], $config);
};

$container['WriteModel'] = function (ContainerInterface $c): WriteModelInterface {
    return new WriteModel(
        $c['EntityManager'],
        $c['logger']
    );
};

$container['SellerRepository'] = function (ContainerInterface $c): SellerRepositoryInterface {
    return new SellerRepository(
        $c['EntityManager']
    );
};

$container['ProductRepository'] = function (ContainerInterface $c): ProductRepositoryInterface {
    return new ProductRepository(
        $c['EntityManager']
    );
};

$container['CartRepository'] = function (ContainerInterface $c): CartRepositoryInterface {
    return new CartRepository(
        $c['EntityManager']
    );
};
