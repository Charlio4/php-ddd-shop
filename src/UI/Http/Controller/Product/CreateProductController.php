<?php

declare(strict_types=1);

namespace Api\UI\Http\Controller\Product;

use Api\Application\Commands\Product\Create\CreateProductCommand;
use Api\Domain\Common\Param;
use Api\UI\Http\Controller\AbstractController;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;
use Throwable;

final class CreateProductController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @throws Throwable
     * @return Response
     *
     * @OA\Post(
     *     path="/product",
     *     tags={"Product"},
     *     summary="Create product",
     *     description="Create product",
     *     operationId="create-product",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="seller_uuid",
     *                     description="Seller identifier",
     *                     type="string",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     description="Product name",
     *                     type="string",
     *                     example="Product test"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Product price",
     *                     type="int",
     *                     example="10.50"
     *                 ),
     *                 required={"name, seller_uuid", "price"}
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

            $name       = $request->getParsedBodyParam(Param::PRODUCT_NAME);
            $sellerUuid = $request->getParsedBodyParam(Param::PRODUCT_SELLER_UUID);
            $price      = $request->getParsedBodyParam(Param::PRODUCT_PRICE);

            $command = new CreateProductCommand($sellerUuid, $name, $price);

            $productId = $this->handler($command);

            return $response->withJson(['product_uuid' => $productId], StatusCode::HTTP_CREATED);
        } catch (Exception $e) {
            return $response->withJson($e->getMessage(), $e->getCode());
        }
    }
}
