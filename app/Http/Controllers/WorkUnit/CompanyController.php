<?php

namespace App\Http\Controllers\WorkUnit;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkUnit\StoreCompanyRequest;
use App\Http\Requests\WorkUnit\UpdateCompanyRequest;
use App\Models\WorkUnit\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();
        return view('pages.work-unit.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->all();

        // buat slug
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('logo_path')) {

            $file = $request->file('logo_path');
            $extension = $file->getClientOriginalExtension();

            $file_name = 'logo_'.$data['slug'].'_'.time().'.'.$extension;

            $data['logo_path'] = $file->storeAs(
                'logo-company',
                $file_name,
                'public_local'
            );
        }

        Company::create($data);

        return redirect()->back()->with('success', 'Data has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $path_logo = $company->logo_path;

        if ($request->hasFile('logo_path')) {
            $file = $request->file('logo_path');
            $extension = $file->getClientOriginalExtension();

            $file_name = 'logo_'.Str::slug($data['name']).'_'.time().'.'.$extension;

            $data['logo_path'] = $file->storeAs('logo-company', $file_name, 'public_local');

            // delete old file
            if ($path_logo && Storage::disk('public_local')->exists($path_logo)) {
                Storage::disk('public_local')->delete($path_logo);
            }

        } else {
            $data['logo_path'] = $path_logo;
        }

        $company->update($data);
        return redirect()->back()->with('success', 'Data has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Data has been deleted successfully!');
    }

}
