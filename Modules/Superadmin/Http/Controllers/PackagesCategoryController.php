<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Superadmin\Entities\Package;
use Modules\Superadmin\Entities\PackageCategory;
use Modules\Superadmin\Entities\SuperadminCoupon;
use Yajra\DataTables\Facades\DataTables;

class PackagesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $category = PackageCategory::get();
            return Datatables::of($category)
                ->addColumn(
                    'action',
                    '
                    <button data-href="{{action(\'\Modules\Superadmin\Http\Controllers\PackagesCategoryController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_package_category_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;
                    
                    
                        <button data-href="{{action(\'\Modules\Superadmin\Http\Controllers\PackagesCategoryController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_package_category_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
                   '
                )
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('superadmin::packages.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input =  $request->except(['_token']);
            PackageCategory::create($input);
            $output = [
                'success' => 1,
                'msg' => __('Package Category Created Successfully'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return  $output;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('superadmin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $package_category = PackageCategory::findorfail($id);

        return view('superadmin::packages.partials.edit', compact('package_category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input =  $request->except(['_token']);

            PackageCategory::findorfail($id)->update($input);

            $output = [
                'success' => 1,
                'msg' => __('Package Category Updated Successfully'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            PackageCategory::where('id', $id)->delete();
            $output = ['success' => 1, 'msg' => __('lang_v1.success')];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
       return $output;
    }
}
