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
        $photos = [];
        $photo = '';

        if ($request->photos) {
            foreach ($request->file('photos') as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->extension();

                $file->move(public_path() . '/uploads', $filename);

                $photos[] = $filename;
            }
        }

        if ($request->photo) {
            $request->file('photo')->move(public_path() . '/uploads', $request->file('photo')->getClientOriginalName());
            $photo = $request->file('photo')->getClientOriginalName();
        }

        $consultations = Consultation::create([
            'customer_id' => $request->customer_id,
            'user_id'     => auth()->user()->id,
            'photo'       => $photo,
            'photos'      => $photos,
            'age'         => $request->age,
            'amount'      => $request->amount,
            'anamnesis'   => $request->anamnesis,
            'datetime'    => date('Y-m-d h:i:s'),
            'status'      => 'Pendiente',
        ]);

        CustomField::saveData($consultations, $request->customField);

        return redirect('/consultations');
    }

    public function show(Consultation $consultation)
    {
        $customers = Customer::orderBy('name')->get();

        $diseases = Disease::orderBy('code')->get();

        $professionals = User::orderBy('name')->get();

        $customFields = CustomField::where('module', '=', 'consultations')->get();

        return view('consultations.show', compact('customFields', 'customers', 'diseases', 'professionals', 'consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $customers = Customer::orderBy('name')->get();

        $diseases = Disease::orderBy('code')->get();

        $professionals = User::orderBy('name')->get();

        $customFields = CustomField::where('module', '=', 'consultations')->get();

        return view('consultations.edit', compact('customFields', 'customers', 'diseases', 'professionals', 'consultation'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        if ($request->file('photos')) {
            foreach ($request->file('photos') as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->extension();

                $file->move(public_path() . '/uploads', $filename);

                $photos[] = $filename;
            }

            $consultation->update(['photos' => $photos]);
        }

        if ($request->file('photo')) {
            $request->file('photo')->move(public_path() . '/uploads', $request->file('photo')->getClientOriginalName());
            $consultation->update(['photo' => $request->file('photo')->getClientOriginalName]);
        }

        $consultations = Consultation::create([
            'customer_id' => $request->customer_id,
            'user_id'     => $request->user_id,
            'age'         => $request->age,
            'amount'      => $request->amount,
            'anamnesis'   => $request->anamnesis,
            'datetime'    => $request->datetime,
            'status'      => $request->status,
        ]);

        CustomField::saveData($consultations, $request->customField);

        return redirect('/consultations');
    }

    public function destroy($id)
    {
        Consultation::find($id)->delete();
        return redirect('/consultations');
    }
}
