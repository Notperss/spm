<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\LocationRequest;
use App\Models\MasterData\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = Location::query();

        $count = Location::count();

        $orderLocation = range(1, $count + 1);
        $lastOrder = $count + 1;

        if (request()->ajax()) {
            return dataTables()->of($q)
                ->addIndexColumn()
                ->addColumn('action', function ($q) use ($orderLocation) {

                    return '

                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-location-'.$q->id.'"
                        class="btn btn-sm btn-icon btn-secondary text-white  mx-1">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    '.view('pages.master-data.location.modal-edit', ['location' => $q, 'orderLocation' => $orderLocation])->render().'

                  <button class="btn btn-sm btn-danger" onclick="confirmDelete(\''.$q->id.'\')">
                        <i class="bi bi-trash"></i>
                    </button>

                    <form id="deleteForm_'.$q->id.'" action="'.route('location.destroy', ['location' => $q]).'" method="POST" style="display:none;">
                        '.method_field('DELETE').csrf_field().'
                    </form>
                    ';

                })

                ->rawColumns(['action',])
                ->toJson();
        }

        return view('pages.master-data.location.index', compact('orderLocation', 'lastOrder'));
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
    public function store(LocationRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'order' => 'required|integer|min:1',
        // ]);


        DB::transaction(function () use ($request) {
            $data = $request->all();

            Location::where('order', '>=', $request->order)
                ->increment('order');

            Location::create($data);
        });

        return redirect()
            ->route('location.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, Location $location)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'order' => 'required|integer|min:1',
        // ]);

        DB::transaction(function () use ($request, $location) {

            $data = $request->all();

            $oldOrder = $location->order;
            $newOrder = $request->order;

            if ($oldOrder != $newOrder) {

                // Naik ke atas (25 -> 22)
                if ($newOrder < $oldOrder) {

                    Location::where('id', '!=', $location->id)
                        ->whereBetween('order', [$newOrder, $oldOrder - 1])
                        ->increment('order');
                }

                // Turun ke bawah (22 -> 25)
                if ($newOrder > $oldOrder) {

                    Location::where('id', '!=', $location->id)
                        ->whereBetween('order', [$oldOrder + 1, $newOrder])
                        ->decrement('order');
                }
            }

            $location->update($data);
        });

        return redirect()
            ->route('location.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        DB::transaction(function () use ($location) {

            $order = $location->order;

            $location->delete();

            Location::where('order', '>', $order)
                ->decrement('order');
        });

        return redirect()->route('location.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
