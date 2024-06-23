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
     * @param GetCustomer $getCustomer The use case for retrieving customers
     * @return Response The JSON response containing customer data or error information
     */
    public function index(GetCustomer $getCustomer): Response
    {
        try {
            $customers = $getCustomer();
            
            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode($customers))
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
     * @param CustomApiException $e The exception that was caught
     * @param int $statusCode The HTTP status code to return
     * @return Response The JSON response containing error information
     */
    private function errorResponse(CustomApiException $e, int $statusCode): Response
    {
        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
                'error' => $e->getErrorMessage(),
                'details' => $e->getErrorDetails(),
            ]))
            ->withStatus($statusCode);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Implementation to be added
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // Implementation to be added
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Implementation to be added
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // Implementation to be added
    }
}