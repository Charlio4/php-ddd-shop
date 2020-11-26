<?php

declare(strict_types=1);

namespace Api\Domain\ValueObj\Base;

class CreatedAt
{
    const FORMAT = 'Y-m-d\TH:i:s.uP';

    use DateTimeTrait;
}
