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
     * show
     *
     * @param  int $id
     * @return ResponseInterface
     */
    public function show(int $id): ResponseInterface
    {
        try {
            $guest = $this->guestService->getGuestById($id);

            if (!$guest) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Guest not found'])->setStatusCode(404);
            }

            return $this->response->setJSON(['status' => 'success', 'message' => 'Guest retrieved successfully', 'data' => $guest])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while retrieving the guest.'])->setStatusCode(500);
        }
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
    
    /**
     * update
     *
     * @param  int $id
     * @return ResponseInterface
     */
    public function update(int $id): ResponseInterface
    {
        try {
            $guest = $this->guestService->getGuestById($id);

            if (!$guest) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Guest not found'])->setStatusCode(404);
            }
            
            $this->guestService->updateGuest($id, $this->request->getJSON(true));

            return $this->response->setJSON(['status' => 'success', 'message' => 'Guest updated successfully', 'data' => []])->setStatusCode(200);
        } catch (\CodeIgniter\Validation\Exceptions\ValidationException $e) {

            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()])->setStatusCode(422);
        } catch (\Exception $e) {
            
            return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while updating the guest.'])->setStatusCode(500);
        }
    }
}