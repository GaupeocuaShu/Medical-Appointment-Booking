<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
                $detailBtn ="<a class='btn btn-info' href='".route("admin.user.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.user.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $detailBtn.$deleteBtn;
            })
            ->addColumn("avatar",function($query){
                return "<img class='rounded-circle object-cover' width='100' height='100' src='".asset($query->avatar)."' alt='$query->name'/>";
            })
            ->addColumn("fullName",function($query){
                return getFullName($query);
            })
            ->addColumn('role', function ($query) { 
                $types = array();
                $types = [
                    "admin" => "Admin",
                    "user" => "User",
                ];
                $typesHTML = "";
                if($query->role == 'doctor') $typesHTML = "<option selected value='doctor'> Doctor </option>";
                else{
                    foreach ($types as $key => $value) {
                        if ($key == $query->role) $typesHTML .= "<option selected value='$key'> $value </option>";
                        else $typesHTML .= "<option  value='$key'> $value </option>";
                    };
                }
                return "<div class=' form-group'><select data-status='$query->role' data-name='role-status' data-url='".route("admin.user.update-role",[$query->id])."' data-id='$query->id' class='status select-status select-status-$query->id form-control'>" . $typesHTML . "</select> </div>";
             })
            ->setRowId('id')
            ->rawColumns(["avatar","action","role"]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where("id","!=",auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
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
            Column::make('avatar')->width(80),
            Column::make('fullName'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('role')->width(200)->addClass('text-capitalize'),
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
        return 'User_' . date('YmdHis');
    }
}
