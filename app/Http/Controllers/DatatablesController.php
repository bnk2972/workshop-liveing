<?php

namespace App\Http\Controllers;

use App\Admin;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DatatablesController extends Controller
{
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $admins = Admin::select(['id', 'name', 'email', 'created_at', 'updated_at']);
        return DataTables::of($admins)->addColumn('action', function($admin){
            return "<a href='/admin/show/{$admin->id}' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span></a>
                    <a href='/admin/delete/{$admin->id}' onClick='return confirm(\"Are you sure?\")' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash'></span></a>";
        })->make(true);
    }
}
