<?php

namespace App\DataTables;

use App\Models\Workplace;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WorkplaceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query)) 
      
            ->addColumn('action', function($query){
                $updateBtn = "<a class='btn btn-primary' href='".route("admin.workplace.edit",$query->id)."'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;"; 
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.workplace.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 

                return $updateBtn.$deleteBtn;
            })
            ->addColumn("status", function ($query) {
                if ($query->status == 1) {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" checked data-url=" ' . route("admin.workplace.change-status", $query->id) . '" class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" data-url=" ' . route("admin.workplace.change-status", $query->id) . '"  class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                }
            })
            ->rawColumns(["action","status","address"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Workplace $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('workplace-table')
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
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('address'),
            Column::make('city'),
            Column::make('province'),
            Column::make('status'),
            Column::make('action')->width(200)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Workplace_' . date('YmdHis');
    }
}
