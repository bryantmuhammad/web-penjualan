<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\SupplierDataTable;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('admin.supplier.index', [
            'title' => 'Supplier Management'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create', [
            'title' => 'Tambah Supplier'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        Supplier::create($request->validated());
        Alert::success('Success', 'Berhasil menambahkan supplier');

        return redirect()->route('dashboard.suppliers.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.update', [
            'title' => 'Edit Supplier',
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        Alert::success('Success', 'Berhasil merubah supplier');

        return redirect()->route('dashboard.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        Alert::success('Success', 'Berhasil menghapus supplier');

        return redirect()->route('dashboard.suppliers.index');
    }
}
