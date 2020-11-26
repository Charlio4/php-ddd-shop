<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Cart;

use Api\Application\Commands\Cart\Buy\BuyCartCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class BuyCartController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @throws Throwable
     * @return Response
     *
     * @OA\Put(
     *     path="/cart/buy",
     *     tags={"Cart"},
     *     summary="Buy cart",
     *     description="Buy cart",
     *     operationId="buy-cart",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="customer_uuid",
     *                     description="Customer identifier",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 required={"customer_uuid"}
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
    public function buy(Request $request, Response $response)
    {
        try {
            $this->isRequestSatisfied($request);

            $customerUuid = $request->getParsedBodyParam(Param::CUSTOMER_UUID);

            $command = new BuyCartCommand($customerUuid);
            $this->handler($command);

            return $response->withStatus(StatusCode::HTTP_OK);
        } catch (Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
