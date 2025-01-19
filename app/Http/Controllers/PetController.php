<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Services\PetService;
use Exception;

class PetController extends Controller
{
    private PetService $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        try {
            $pets = $this->petService->getAllPets();
            return view('pets.index', ['pets' => $pets]);
        } catch (Exception $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Failed to load pets. Please try again later.']);
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        try {
            $data = $request->validated();
            $this->petService->createPet($data);
            return redirect()->route('pets.index')->with('success', 'Pet has been added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to add the pet. Please try again later.']);
        }
    }

    public function edit(int $id)
    {
        try {
            $pet = $this->petService->getPetById($id);
            return view('pets.edit', compact('pet'));
        } catch (Exception $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Failed to retrieve pet data. Please try again later.']);
        }
    }

    public function update(UpdatePetRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $data['id'] = $id;
            $this->petService->updatePet($data);
            return redirect()->route('pets.index')->with('success', 'Pet has been updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the pet. Please try again later.']);
        }
    }

    public function destroy($id)
    {
        try {
            $this->petService->deletePet($id);
            return redirect()->route('pets.index')->with('success', 'Pet has been deleted successfully!');
        } catch (Exception $e) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Failed to delete the pet. Please try again later.']);
        }
    }
}
