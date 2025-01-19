<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Pagination\LengthAwarePaginator;

class PetService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://petstore.swagger.io/v2/']);
    }

    public function getAllPetsFromApi(): array
    {
        try {
            $response = $this->client->get('pet/findByStatus', [
                'query' => ['status' => 'available']
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception('API returned an error.');
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw new \Exception('Error fetching pets from the API. Please try again later.');
        }
    }

    public function getAllPets(int $perPage = 10): LengthAwarePaginator
    {
        try {
            $pets = $this->getAllPetsFromApi();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $items = collect($pets);
            $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();

            return new LengthAwarePaginator(
                $currentItems,
                $items->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getPetById(int $id)
    {
        try {
            $response = $this->client->get("pet/{$id}");
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception('Error fetching pet details. Please check the pet ID and try again.');
        }
    }

    public function createPet(array $data)
    {
        try {
            $this->client->post('pet', ['json' => $data]);
        } catch (RequestException $e) {
            throw new \Exception('Error creating the pet. Please ensure the data is valid and try again.');
        }
    }

    public function updatePet(array $data)
    {
        try {
            $this->client->put('pet', ['json' => $data]);
        } catch (RequestException $e) {
            throw new \Exception('Error updating the pet. Please ensure the data is valid and try again.');
        }
    }

    public function deletePet(int $id)
    {
        try {
            $this->client->delete("pet/{$id}");
        } catch (RequestException $e) {
            throw new \Exception('Error deleting the pet. Please check the pet ID and try again.');
        }
    }
}
