<?php

namespace App\Http\Controllers;

use App\DataTables\ActivitiesDataTable;
use App\DataTables\BookingsDataTable;
use App\DataTables\AjaxActivitiesDataTable;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ActivitiesController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function index(Request $request, ActivitiesDataTable $dataTable)
    {
        if ($request->ajax()) {
            return $dataTable->ajax();
        }else{
            return view('activities.index');
        }
    }

    public function ajaxSearch(AjaxActivitiesDataTable $dataTable):object
    {
        return $dataTable->ajax();
    }

    public function create()
    {
         //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Activity $activity): View
    {
        return view('activities.show',compact('activity'));
    }


    public function edit(Activity $activities)
    {
        //
    }

    public function update(Request $request, Activity $activities)
    {
        //
    }

    public function destroy(Activity $activities)
    {
        //
    }
}
