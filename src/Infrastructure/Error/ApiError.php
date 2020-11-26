<?php

declare(strict_types=1);

namespace Api\Infrastructure\Error;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Handlers\Error;
use Slim\Http\Body;
use Slim\Http\StatusCode;

/**
 * Class ApiError.
 */
final class ApiError extends Error
{
    protected Logger $logger;

    protected $displayErrorDetails;

    /**
     * ApiError constructor.
     * @param Logger $logger
     * @param bool $displayErrorDetails
     */
    public function __construct(Logger $logger, $displayErrorDetails = false)
    {
        $this->logger              = $logger;
        $this->displayErrorDetails = $displayErrorDetails;
        parent::__construct($displayErrorDetails);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param \Exception $exception
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $exception): Response
    {
        // Log the message
        $log = [
            'http_code'        => StatusCode::HTTP_INTERNAL_SERVER_ERROR,
            'http_description' => $exception->getMessage(),
        ];

        $this->logger->critical(null, $log);

        $error = [
            'error' => $exception->getMessage(),
            'code'  => $exception->getCode(),
        ];
        if ($this->displayErrorDetails) {
            array_push($error, ['trace' => $exception->getTrace()]);
        }

        // create a JSON error string for the Response body
        $body = json_encode($error, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return $response
            ->withStatus(StatusCode::HTTP_INTERNAL_SERVER_ERROR)
            ->withHeader('Content-type', 'application/json')
            ->withBody(new Body(fopen('php://temp', 'r+')))
            ->write($body);
    }
}
