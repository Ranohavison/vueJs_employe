<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function checkNumEmp($numEmp)
    {
        $exists = Employe::where('numEmp', $numEmp)->exists();

        return response()->json(['exists' => $exists]);
    }

    // Liste tous les employés
    public function index()
    {
        $employes = Employe::all();
        return response()->json($employes);
    }

    // Affiche un employé par son numEmp
    public function show($numEmp)
    {
        $employe = Employe::find($numEmp);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        return response()->json($employe);
    }

    // Crée un nouvel employé
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numEmp' => 'required|string|unique:employes,numEmp',
            'nom' => 'required|string',
            'salaire' => 'required|integer',
        ]);

        $employe = Employe::create($validated);

        return response()->json($employe, 201);
    }

    // Met à jour un employé existant
    public function update(Request $request, $numEmp)
    {
        $employe = Employe::find($numEmp);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        $validated = $request->validate([
            'nom' => 'sometimes|required|string',
            'salaire' => 'sometimes|required|integer',
        ]);

        $employe->update($validated);

        return response()->json($employe);
    }

    // Supprime un employé
    public function destroy($numEmp)
    {
        $employe = Employe::find($numEmp);

        if (!$employe) {
            return response()->json(['message' => 'Employé non trouvé'], 404);
        }

        $employe->delete();

        return response()->json(['message' => 'Employé supprimé']);
    }
}
