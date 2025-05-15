<?php

namespace  App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\GuestService;
use App\Repositories\GuestRepository;
use CodeIgniter\HTTP\ResponseInterface;

class GuestController extends BaseController
{
    protected $guestService;

    public function __construct()
    {
        $this->guestService = new GuestService(new GuestRepository());
    }
    
    /**
     *
     * @return ResponseInterface
     */
    public function index(): ResponseInterface
    {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Guests retrieved successfully',
            'data' => $this->guestService->getAllGuests()
        ])->setStatusCode(200);
    }    
    
    
    /**
     * store
     *
     * @return ResponseInterface
     */
    public function store(): ResponseInterface
    {
        try {
            $guest = $this->guestService->createGuest($this->request->getJSON(true));

            return $this->response->setJSON(['status' => 'success','message' => 'Guest created successfully','data' => $guest])->setStatusCode(201);
        } catch (\CodeIgniter\Validation\Exceptions\ValidationException $e) {

            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()])->setStatusCode(422);
        } catch (\Exception $e) {

            return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while creating the guest.'])->setStatusCode(500);
        }
    }
}