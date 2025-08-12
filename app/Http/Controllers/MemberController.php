<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Spouse;
use App\Models\Child;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with(['spouse', 'children'])
            ->orderBy('first_name')
            ->paginate(15);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:members,email',
            'profition' => 'nullable|string|max:255',
            'province_bith' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'marital_status' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_factos',
            'date_marriag' => 'nullable|date',
            'baptized' => 'nullable|in:y,n',
            'marriag_church' => 'nullable|in:y,n',
            'church_name_marriag' => 'nullable|string',
            'date_baptism' => 'nullable|date',
            'batizad_from_marriag' => 'required|in:y,n',
            'has_position_church' => 'required|in:y,n',
            'position' => 'nullable|string',
            'date_joined' => 'required|date',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',

            // Dados da esposa (se casado)
            'spouse_first_name' => 'nullable|string|max:255',
            'spouse_last_name' => 'nullable|string|max:255',
            'spouse_date_of_birth' => 'nullable|date',
            'spouse_phone_number' => 'nullable|string|max:20',
            'spouse_email' => 'nullable|email|unique:spouses,email',

            // Dados dos filhos
            'children' => 'nullable|array',
            'children.*.first_name' => 'required|string|max:255',
            'children.*.last_name' => 'required|string|max:255',
            'children.*.date_of_birth' => 'required|date',
            'children.*.gender' => 'required|string|max:255',
        ]);

        #dd($validated);

        // Gerenciar upload da foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/members_photos', $filename);
            $validated['photo'] = $filename;
        }
       # dd($validated);
        // Criação do membro
        $member = Member::create($validated);

        // Criar esposa se fornecida
        if ($request->filled('spouse_first_name') && $validated['marital_status'] === 'casado') {
            Spouse::create([
                'member_id' => $member->id,
                'first_name' => $validated['spouse_first_name'],
                'last_name' => $validated['spouse_last_name'],
                'date_of_birth' => $validated['spouse_date_of_birth'],
                'phone_number' => $validated['spouse_phone_number'],
                'email' => $validated['spouse_email'],
            ]);
        }

        // Criar filhos se fornecidos
        if (!empty($validated['children'])) {
            foreach ($validated['children'] as $childData) {
                Child::create([
                    'member_id' => $member->id,
                    'first_name' => $childData['first_name'],
                    'last_name' => $childData['last_name'],
                    'date_of_birth' => $childData['date_of_birth'],
                    'gender' => $childData['gender'],
                ]);
            }
        }

        return redirect()->route('members.index')
            ->with('success', 'Membro cadastrado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        $member->load(['spouse', 'children', 'financialTransactions']);

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $member->load(['spouse', 'children']);


        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:members,email,' . $member->id,
            'profition' => 'nullable|string|max:255',
            'province_bith' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'marital_status' => 'required|in:solteiro,casado,divorciado,viuvo,uniao_factos',
            'date_marriag' => 'nullable|date',
            'baptized' => 'nullable|in:y,n',
            'marriag_church' => 'nullable|in:y,n',
            'church_name_marriag' => 'nullable|string',
            'date_baptism' => 'nullable|date',
            'batizad_from_marriag' => 'required|in:y,n',
            'has_position_church' => 'required|in:y,n',
            'position' => 'nullable|string',
            'date_joined' => 'required|date',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Atualiza a foto, se fornecida
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/members_photos', $filename);
            $validated['photo'] = $filename;
        }

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Membro atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Membro removido com sucesso!');
    }
}
