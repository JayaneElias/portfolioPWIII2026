<?php
namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ChirpController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)  
            ->get();
        return view('home', ['chirps' => $chirps]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // para a autenticação do usuário, para validar
        auth()->user()->chirps()->create($validated);
        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    public function edit(Chirp $chirp)
    {
        // só deixo editar se for permitido (dono ou policy) para manter uma segurança
        $this->authorize('update', $chirp);
        return view('chirps.edit', compact('chirp'));
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);
        return redirect('/')->with('success', 'Chirp updated!');
    }

    public function destroy(Chirp $chirp)
    {
        // Aqui vai só apagar se tiver a permissão
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect('/')->with('success', 'Chirp deleted!');
    }
}