<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = Activity::with('causer')->latest();

        if (request()->ajax()) {
            return DataTables::of($activities)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $content = view('pages.activity-log.content', compact('item'))->render();

                    $modal = '
                <div class="modal fade" id="modal-content-'.$item->id.'" tabindex="-1" aria-labelledby="modalLabel-'.$item->id.'" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-'.$item->id.'">log Detail</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            '.$content.'
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';

                    // Create the button that triggers the modal
                    $button = '
                <a data-bs-toggle="modal" data-bs-target="#modal-content-'.$item->id.'" class="btn btn-primary" title="Show">
                    <i class="bi bi-eye"></i>
                </a>';

                    // Return both the button and the modal content
                    return $button.$modal;

                })
                ->editColumn('causer', function ($item) {
                    $causerName = optional($item->causer)->name ?? 'N/A';
                    $causerRole = optional($item->causer)->getRoleNames() ?? 'N/A';
                    return $causerName.' '.$causerRole;
                })
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->diffForHumans() ?? 'N/A';
                })
                // ->editColumn('regarding', function ($item) {

                // })
                ->rawColumns(['action', 'causer'])
                ->toJson();
        }

        return view('pages.activity-log.index', compact('activities'));
    }

    public function systemLogs()
    {
        $path = storage_path('logs/laravel.log');

        if (! File::exists($path)) {
            abort(404, 'Log file tidak ditemukan');
        }

        $logs = File::get($path);

        // Ambil hanya ERROR
        $lines = collect(explode("\n", $logs))
            ->filter(fn ($line) => str_contains($line, '.ERROR'))
            ->reverse()
            ->take(100); // batasi 100 error terakhir

        return view('pages.activity-log.system-logs', compact('lines'));
    }
}
