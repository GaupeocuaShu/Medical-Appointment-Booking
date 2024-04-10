<?php

namespace App\DataTables;

use App\Models\DoctorSchedule;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\User;
use Illuminate\Support\Carbon;
class DoctorScheduleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $role = auth()->user()->role; 
        return (new EloquentDataTable($query))
            ->addColumn("patient",function($query){
                $user = User::findOrFail($query->user_id);
                return getFullName($user);
            })
            ->addColumn('appointment_time',function($query){
                $date = Carbon::create($query->appointment); 
                return $date->isoFormat("HH:mm");
            })
            ->addColumn('appointment_date',function($query){
                $date = Carbon::create($query->appointment); 
                return $date->isoFormat("DD-MM-YY");
            })
            ->addColumn("status",function($query){
                $html = "<span class='btn btn-outline-dark text-capitalize'>$query->status</span>";
                return  $html;
            })
            ->addColumn("action",function($query) use ($role){ 
                if($role == 'admin'){
                    $showBtn = "<a class='btn btn-info' href='".route("admin.schedule.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
                    $updateBtn = "<a class='btn btn-primary' href='".route("admin.doctor.edit",$query->id)."'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;"; 
                    $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.doctor.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                    return $showBtn.$updateBtn.$deleteBtn;
                }
                else {
                    $showBtn = "<a class='btn btn-info' href='".route("doctor.schedule.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
                    return $showBtn;
                }
            })
            ->filterColumn("status", function ($query, $keyWord) {
                return $query->where("status",$keyWord );
            })
            ->filterColumn("appointment_date", function ($query, $keyWord) {

                return $query->whereDate("appointment",$keyWord);
            })
            ->rawColumns(["patient","appointment","action","status"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Schedule $model): QueryBuilder
    {
        return $model->where("doctor_id",$this->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('doctorschedule-table')
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
            Column::make('patient_id'),
            Column::make('patient'),
            Column::make('appointment_date'),
            Column::make('appointment_time'),
            Column::make('status'),
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
        return 'DoctorSchedule_' . date('YmdHis');
    }
}
