<?php

namespace App\DataTables;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenjualanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $eloquentDataTable = new EloquentDataTable($query);
        if (request()->segment(3) == 'selesai') {
            $eloquentDataTable->addColumn('detail', 'admin.penjualan.datatable-detail')
                ->rawColumns(['detail']);
        } else {

            $eloquentDataTable->addColumn('action', 'admin.penjualan.datatable-action')
                ->addColumn('detail', 'admin.penjualan.datatable-detail')
                ->rawColumns(['action', 'detail']);
        }

        $eloquentDataTable->addColumn('user_id', function ($query) {
            return $query->user->name;
        })
            ->addColumn('ongkir', function ($query) {
                return rupiah($query->ongkir);
            })
            ->addColumn('total', function ($query) {
                return rupiah($query->total);
            })
            ->setRowId('id');

        return $eloquentDataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Penjualan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Penjualan $model): QueryBuilder
    {
        if (request()->segment(3) == 'belumbayar') {
            return $model->newQuery()->where('status', 1)->with('user');
        } else if (request()->segment(3) == 'sudahbayar') {
            return $model->newQuery()->where('status', 2)->with('user');
        } else {
            return $model->newQuery()->where('status', '>', 2)->with('user');
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penjualan-table')
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
        $column =  [
            Column::make('id_penjualan')->title('Id Penjualan')->addClass('text-center'),
            Column::make('user_id')->title('Customer')->addClass('text-center'),
            Column::make('detail')->title('Detail')->addClass('text-center'),
            Column::make('ongkir')->title('Ongkos Kirim')->addClass('text-center'),
            Column::make('total')->title('Total Harga')->addClass('text-center'),


        ];

        if (request()->segment(3) !== 'selesai') {
            $column[] =  Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)->addClass('text-center');
        }


        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Penjualan_' . date('YmdHis');
    }
}
