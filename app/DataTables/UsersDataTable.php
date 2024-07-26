<?php
namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
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
        })
        ->addColumn('role', function ($row) {

            return ucwords(str_replace("-"," ",implode(",",$row->getRoleNames()->toArray())));
        })->editColumn('created_at',function($raw) {
            return  default_dateformat($raw->created_at);
        })->editColumn('image',function($raw) {
            return  '<img src="'.asset($raw->image).'" width="42px" alt="'.$raw->name.'" />';
        })
        ->rawColumns(['checkbox','action','role','image']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('roles')->whereHas('roles',function($query){
            $query->where('name','!=','superadmin');
        });
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->parameters([
                        'responsive' => true,
                        // 'drawCallback' => 'function () {rowSelectHandler();}',
                        'initComplete' => 'function () {dataTableInitHandler();}',
                        // 'preDrawCallback' => 'function () {toggleLoader();}',
                    ])
                    ->setTableId('data-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->serverSide(true)
                    ->processing(true)
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::computed("checkbox", '<input class="form-check-input" type="checkbox" id="select-all">')->orderable(false),
            Column::computed('DT_RowIndex', '#'),
            Column::make('image')->orderable(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
            Column::make('created_at'),
            Column::make('action')
            ->exportable(false)
            ->printable(false)
        ];
    }

    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
