<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Product;

use Api\Application\Commands\Product\Delete\DeleteProductCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class DeleteProductController extends AbstractController
{
    /**
     * @OA\Delete(
     *     path="/product/uuid/{uuid}",
     *     tags={"Product"},
     *     summary="Delete product by uuid",
     *     description="Delete product by uuid",
     *     operationId="delete-product-by-uuid",
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         description="Product identifier",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
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
    public function delete(Request $request, Response $response)
    {
        try {
            $this->isRequestSatisfied($request);

            $uuid = $request->getAttribute(Param::UUID);

            $command = new DeleteProductCommand($uuid);
            $this->handler($command);

            return $response->withStatus(StatusCode::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
