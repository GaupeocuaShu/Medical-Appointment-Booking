<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Post;
use Illuminate\Support\Carbon;
class PostManagementDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_at',function($query){
                $carbonDateTime = Carbon::create($query->created_at)->isoFormat("HH:mm DD/MM/YYYY");
                return $carbonDateTime;
            })
            ->addColumn('creator',function($query){
                return $query->user->doctor->academic_degree ." ".getFullName($query->user);
            })
            ->addColumn('action', function($query){
                $updateBtn = "<a class='btn btn-info' href='".route("admin.post.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.post.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $updateBtn.$deleteBtn;
            })
            ->addColumn("status", function ($query) {
                if ($query->status == "active" ) {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" checked data-url=" ' . route("admin.post.change-status", $query->id) . '" class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" data-url=" ' . route("admin.post.change-status", $query->id) . '"  class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                }
            })
            ->rawColumns(["action","status"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Post $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('postmanagement-table')
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
            Column::make('title'),
            Column::make('creator'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PostManagement_' . date('YmdHis');
    }
}
