<?php

namespace App\DataTables;

use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PembelianDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'pembelian.action')
            ->addColumn('supplier', function ($query) {
                return $query->supplier->nama_supplier;
            })
            ->addColumn('total_pembelian', function ($query) {
                return rupiah($query->total_pembelian);
            })
            ->addColumn('tanggal_pembelian', function ($query) {
                return date("j F Y", strtotime($query->tanggal_pembelian));
            })
            ->addColumn('detail_pembelian', 'admin.pembelian.datatable-action')
            ->rawColumns(['detail_pembelian'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pembelian $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pembelian $model): QueryBuilder
    {
        return $model->newQuery()->with('supplier');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pembelian-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('supplier')->title('Supplier'),
            Column::make('tanggal_pembelian')->title('Tanggal Pembelian'),
            Column::make('total_pembelian')->title('Total Harga'),
            Column::make('detail_pembelian')->title('Detail Pembelian')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pembelian_' . date('YmdHis');
    }
}
