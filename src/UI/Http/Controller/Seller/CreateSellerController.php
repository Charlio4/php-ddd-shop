<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Seller;

use Api\Application\Commands\Seller\Create\CreateSellerCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class CreateSellerController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @throws Throwable
     * @return Response
     *
     * @OA\Post(
     *     path="/seller",
     *     tags={"Seller"},
     *     summary="Create seller",
     *     description="Create seller",
     *     operationId="create-seller",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Seller name",
     *                     type="string",
     *                     example="Seller test"
     *                 ),
     *                 required={"name"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Create resource",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad arguments"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function create(Request $request, Response $response)
    {
        try {
            $this->isRequestSatisfied($request);

            $name = $request->getParsedBodyParam(Param::SELLER_NAME);

            $command    = new CreateSellerCommand($name);
            $sellerUuid = $this->handler($command);

            return $response->withJson(['seller_uuid' => $sellerUuid], StatusCode::HTTP_CREATED);
        } catch (Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
