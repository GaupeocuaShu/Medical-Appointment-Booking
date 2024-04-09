<?php

namespace App\DataTables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorDataTable extends DataTable
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
                $moreBtn = '
                <div class="dropdown d-inline">
                      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-plane-departure"></i>
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item has-icon" href="'.route("admin.doctor.show",$query->id).'"><i class="fa-solid fa-circle-info"></i>Detail</a>
                        <a class="dropdown-item has-icon" href="'.route("admin.doctor.working-time",$query->id).'"><i class="fa-solid fa-stopwatch"></i>Add Working Time</a>
                        <a class="dropdown-item has-icon" href="'.route("admin.doctor.schedule.index",$query->id).'"><i class="fa-regular fa-calendar-check"></i></i>Schedule</a>
                      </div>
                    </div>
                    &emsp;
                ';
                $scheduleBtn = "<a class='btn btn-success' href='".route("admin.doctor.schedule.index",$query->id)."'><i class='fa-regular fa-calendar-check'></i></a> &emsp;"; 
                // $workingTimeBtn = "<a class='btn btn-success' href='".route("admin.doctor.working-time",$query->id)."'><i class='fa-regular fa-calendar-check'></i></a> &emsp;"; 
                $showBtn = "<a class='btn btn-info' href='".route("admin.doctor.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
                $updateBtn = "<a class='btn btn-primary' href='".route("admin.doctor.edit",$query->id)."'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;"; 
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.doctor.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return  $moreBtn.$updateBtn.$deleteBtn;
            })
            ->addColumn('title',function($query){
                return $query->academic_degree." ".getFullName($query->user);
            })

            ->addColumn('experienceYear',function($query){
                return $query->experience_year." Experience Years";
            })
            ->rawColumns(["action","title"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Doctor $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('doctor-table')
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
            Column::make('experienceYear'),
       
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(300)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Doctor_' . date('YmdHis');
    }
}
