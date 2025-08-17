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
    $data = $request->all();

    // Upload da foto
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/members_photos', $filename);
        $data['photo'] = $filename;
    }

    // ✅ Verificar duplicado de email
    if (!empty($data['email']) && Member::where('email', $data['email'])->exists()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Já existe um membro com este email.');
    }

    // Criar membro
    $member = Member::create([
        'first_name'        => $data['first_name'] ?? null,
        'last_name'         => $data['last_name'] ?? null,
        'date_of_birth'     => $data['date_of_birth'] ?? null,
        'gender'            => $data['gender'] ?? null,
        'address'           => $data['address'] ?? null,
        'phone_number'      => $data['phone_number'] ?? null,
        'email'             => $data['email'] ?? null,
        'profition'         => $data['profition'] ?? null,
        'province_bith'     => $data['province_bith'] ?? null,
        'neighborhood'      => $data['neighborhood'] ?? null,
        'marital_status'    => $data['marital_status'] ?? null,
        'date_marriag'      => $data['date_marriag'] ?? null,
        'baptized'          => $data['baptized'] ?? null,
        'marriag_church'    => $data['marriag_church'] ?? null,
        'church_name_marriag' => $data['church_name_marriag'] ?? null,
        'date_baptism'      => $data['date_baptism'] ?? null,
        'batizad_from_marriag' => $data['batizad_from_marriag'] ?? null,
        'has_position_church'  => $data['has_position_church'] ?? null,
        'position'          => $data['position'] ?? null,
        'date_joined'       => $data['date_joined'] ?? null,
        'notes'             => $data['notes'] ?? null,
        'photo'             => $data['photo'] ?? null,
    ]);

    // Criar esposa se casado
    if (in_array(($data['marital_status'] ?? ''), ['casado', 'uniao_factos'])
        && !empty($data['spouse_first_name'])) {
        Spouse::create([
            'member_id'     => $member->id,
            'first_name'    => $data['spouse_first_name'] ?? null,
            'last_name'     => $data['spouse_last_name'] ?? null,
            'date_of_birth' => $data['spouse_date_of_birth'] ?? null,
            'phone_number'  => $data['spouse_phone_number'] ?? null,
            'email'         => $data['spouse_email'] ?? null,
        ]);
    }


    // Criar filhos
    if (!empty($data['children']) && is_array($data['children'])) {
        foreach ($data['children'] as $child) {
            Child::create([
                'member_id'     => $member->id,
                'first_name'    => $child['first_name'] ?? null,
                'last_name'     => $child['last_name'] ?? null,
                'date_of_birth' => $child['date_of_birth'] ?? null,
                'gender'        => $child['gender'] ?? null,
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
