<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Cart;

use Api\Application\Commands\Cart\GetTotal\GetTotalCartCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

final class GetTotalCartController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/cart/total/{customer_uuid}",
     *     tags={"Cart"},
     *     summary="Get total cart",
     *     description="Get total cart",
     *     operationId="get-total-cart",
     *     @OA\Parameter(
     *         name="customer_uuid",
     *         in="path",
     *         description="Customer identifier",
     *         required=true,
     *         @OA\Schema(
     *             type=""
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
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
    public function get(Request $request, Response $response)
    {
        try {
            $this->isRequestSatisfied($request);

            $customerUuid = $request->getAttribute(Param::CUSTOMER_UUID);

            $command   = new GetTotalCartCommand($customerUuid);
            $totalCart = $this->handler($command);

            return $response->withJson([Param::CART_TOTAL_AMOUNT => $totalCart], StatusCode::HTTP_OK);
        } catch (Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
