<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PersonController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(): JsonResponse
    {
        $people = Person::all();
        
        return response()->json(['data' => $people]);
    }

    /**
     * show
     *
     * @return void
     */
    public function show(int $id): JsonResponse
    {
        $person = Person::findOrFail($id);
        
        return response()->json(['data' => $person]);
    }
    
    /**
     * create
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $person = new Person(['name' => $request->name]);
        $person->save();

        return response()->json(['data' => $person, 'message' => 'Successfully created!']);
    }
    
    /**
     * update
     *
     * @param Request request
     * @param int id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $person = Person::findOrFail($id);
        $person->name = $request->name;
        $person->save();

        return response()->json(['data' => $person, 'message' => 'Successfully updated!']);
    }
    
    /**
     * destroy
     *
     * @param int id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $person = Person::findOrFail($id);
        $person->contacts()->delete();
        $person->delete();

        return response()->json(['message' => 'Successfully deleted!']);
    }
}
