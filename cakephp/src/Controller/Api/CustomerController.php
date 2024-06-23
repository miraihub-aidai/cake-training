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
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class CustomerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
    }
}
