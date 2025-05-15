<?php

namespace App\Services;

use App\Repositories\Contracts\GuestRepositoryInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;

class GuestService
{
    public function __construct(private GuestRepositoryInterface $guestRepository)
    {}
    
    /**
     * getAllGuests
     *
     * @return array
     */
    public function getAllGuests(): array
    {
        return $this->guestRepository->getAll();
    }
    
    /**
     * getGuestById
     *
     * @param  int $id
     * @return array|null
     */
    public function getGuestById(int $id): ?array
    {
        return $this->guestRepository->getById($id);
    }
    
    /**
     * createGuest
     *
     * @param  array $data
     * @return array
     */
    public function createGuest(array $data): array
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'  => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|max_length[150]|is_unique[guests.email]',
            'phone' => 'permit_empty|max_length[20]',
        ]);

        if (!$validation->run($data)) {
            throw new ValidationException(implode(', ', $validation->getErrors()));
        }

       return $this->guestRepository->create($data);
    }
    
    /**
     * updateGuest
     *
     * @param  int $id
     * @param  array $data
     * @return bool
     */
    public function updateGuest(int $id, array $data): bool
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name'  => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|max_length[150]|is_unique[guests.email,id,'.$id.']',
            'phone' => 'permit_empty|max_length[20]',
        ]);

        if (!$validation->run($data)) {
            throw new ValidationException(implode(', ', $validation->getErrors()));
        }

        return $this->guestRepository->update($id, $data);
    }
    
    /**
     * deleteGuest
     *
     * @param  int $id
     * @return bool
     */
    public function deleteGuest(int $id): bool
    {
        return $this->guestRepository->delete($id);
    }
}