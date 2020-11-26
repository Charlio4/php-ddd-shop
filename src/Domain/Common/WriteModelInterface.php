<?php

declare(strict_types=1);

namespace Api\Domain\Common;

interface WriteModelInterface
{
    public function preSave($entity): void;

    public function save($entity = null): void;

    public function update($entity = null): void;

    public function delete($entity): void;
}
