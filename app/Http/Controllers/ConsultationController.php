<?php

namespace App\Http\Controllers;

use App\Consultation;
use App\CustomField;
use App\Customer;
use App\Disease;
use App\User;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::orderByDesc('id')->get();
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        $diseases = Disease::orderBy('code')->get();

        $professionals = User::orderBy('name')->get();

        $customFields = CustomField::where('module', '=', 'consultations')->get();

        return view('consultations.create', compact('customFields', 'customers', 'diseases', 'professionals'));
    }

    public function store(Request $request)
    {
        foreach ($request->file('files') as $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->extension();

            $file->move(public_path() . '/uploads', $filename);

            $photos[] = $filename;
        }

        $request->file('photo')->move(public_path() . '/uploads', $request->file('photo')->getClientOriginalName());

        Consultation::create([
            'customer_id' => $request->customer_id,
            'user_id'     => $request->user_id,
            'photo'       => $request->file('photo')->getClientOriginalName,
            'photos'      => $photos,
            'age'         => $request->age,
            'amount'      => $request->amount,
            'anamnesis'   => $request->anamnesis,
            'datetime'    => $request->datetime,
            'status'      => $request->status,
        ]);

        CustomField::saveData($consultations, $request->customField);

        return redirect('/consultations');
    }

    public function show(Session $session)
    {

    }

    public function edit($id)
    {
        $customers = Customer::orderBy('name')->get();

        $diseases = Disease::orderBy('code')->get();

        $professionals = User::orderBy('name')->get();

        $customFields = CustomField::where('module', '=', 'consultations')->get();

        return view('consultations.edit', compact('customFields', 'customers', 'diseases', 'professionals'));
    }

    public function update(Request $request, Session $session)
    {

    }

    public function destroy($id)
    {

    }
}
