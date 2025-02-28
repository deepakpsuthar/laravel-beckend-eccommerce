<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->setRowId('id')
        ->addColumn('checkbox', function($raw) {
            return '<input class="form-check-input"  name="ids[]" type="checkbox" value="' . $raw->id .'"/>';
        })
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

            return $row->action;
        })->editColumn('created_at',function($raw) {
            return  default_dateformat($raw->created_at);
        })->editColumn('image',function($raw) {
            return  '<img src="'.asset($raw->image).'" width="42px" alt="'.$raw->name.'" />';
        }) ->rawColumns(['checkbox','action','image','status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->parameters([
                        'responsive' => true,
                        'initComplete' => 'function () {dataTableInitHandler();}',
                        ])
                    ->setTableId('data-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->serverSide(true)
                    ->processing(true)
                    ->selectStyleSingle();
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed("checkbox", '<input class="form-check-input"  type="checkbox" id="select-all">')->orderable(false),
            Column::computed('DT_RowIndex', '#'),
            Column::make('image')->orderable(false),
            Column::make('name'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('action')
            ->exportable(false)
            ->printable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
