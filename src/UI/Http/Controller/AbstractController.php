<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller;

use Api\Application\CommandInterface;
use Api\Domain\Specification\Request\RequestSpecificationInterface;
use League\Tactician\CommandBus;
use Slim\Http\Request;

/**
 * @OA\Info(title="Shop API", version="1.0")
 */
abstract class AbstractController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var RequestSpecificationInterface */
    private $specification;


    public function __construct(
        CommandBus $commandBus,
        RequestSpecificationInterface $specification
    ) {
        $this->commandBus    = $commandBus;
        $this->specification = $specification;
    }


    public function handler(CommandInterface $command)
    {
        return $this->commandBus->handle($command);
    }


    public function isRequestSatisfied(Request $request)
    {
        return $this->specification->isSatisfiedBy($request);
    }
}
