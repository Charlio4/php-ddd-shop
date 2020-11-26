<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Cart;

use Api\Application\Commands\Cart\RemoveFromCart\RemoveProductFromCartCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

final class RemoveProductFromCartController extends AbstractController
{
    /**
     * @OA\Put(
     *     path="/cart/product",
     *     tags={"Cart"},
     *     summary="Remove product from cart",
     *     description="Remove product from cart",
     *     operationId="remove-product-from-cart",
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
     *                 @OA\Property(
     *                     property="product_uuid",
     *                     description="Product identifier",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     description="Product quantity",
     *                     type="int",
     *                     example=3
     *                 ),
     *                 required={"customer_uuid, product_uuid", "quantity"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="No content",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad arguments"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error."
     *     )
     * )
     *
     * @param Request $request
     * @param Response $response
     * @throws Throwable
     * @return Response
     */
    public function remove(Request $request, Response $response)
    {
        try {
            $this->isRequestSatisfied($request);

            $customerUuid = $request->getParsedBodyParam(Param::CUSTOMER_UUID);
            $productUuid  = $request->getParsedBodyParam(Param::PRODUCT_UUID);
            $quantity     = $request->getParsedBodyParam(Param::PRODUCT_QUANTITY);

            $command = new RemoveProductFromCartCommand(
                $customerUuid,
                $productUuid,
                (int) $quantity
            );

            $this->handler($command);

            return $response->withStatus(StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
