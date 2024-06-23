<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Domain\UseCase\GetCustomer;
use App\Error\BadRequestException;
use App\Error\CustomApiException;
use App\Error\ForbiddenException;
use App\Error\InternalServerErrorException;
use App\Error\NotFoundException;
use App\Error\UnauthorizedException;
use Cake\Http\Response;

/**
 * CustomerController
 *
 * This controller handles API requests related to customers.
 */
class CustomerController extends AppController
{
    /**
     * Index method
     *
     * Retrieves a list of customers.
     *
     * @param \App\Domain\UseCase\GetCustomer $getCustomer The use case for retrieving customers
     * @return \Cake\Http\Response The JSON response containing customer data or error information
     */
    public function index(GetCustomer $getCustomer): Response
    {
        try {
            $customers = $getCustomer();

            return $this->response
                ->withType('application/json')
                ->withStringBody((string)json_encode($customers))
                ->withStatus(200);
        } catch (BadRequestException $e) {
            return $this->errorResponse($e, 400);
        } catch (UnauthorizedException $e) {
            return $this->errorResponse($e, 401);
        } catch (ForbiddenException $e) {
            return $this->errorResponse($e, 403);
        } catch (NotFoundException $e) {
            return $this->errorResponse($e, 404);
        } catch (InternalServerErrorException $e) {
            return $this->errorResponse($e, 500);
        } catch (CustomApiException $e) {
            return $this->errorResponse($e, $e->getCode());
        }
    }

    /**
     * Generate an error response
     *
     * @param \App\Error\CustomApiException $e The exception that was caught
     * @param int $statusCode The HTTP status code to return
     * @return \Cake\Http\Response The JSON response containing error information
     */
    private function errorResponse(CustomApiException $e, int $statusCode): Response
    {
        return $this->response
            ->withType('application/json')
            ->withStringBody((string)json_encode([
                'error' => $e->getErrorMessage(),
                'details' => $e->getErrorDetails(),
            ]))
            ->withStatus($statusCode);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null): ?Response
    {
        // Implementation to be added
        return null;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(): ?Response
    {
        // Implementation to be added
        return null;
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null): ?Response
    {
        // Implementation to be added
        return null;
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null): ?Response
    {
        // Implementation to be added
        return null;
    }
}
