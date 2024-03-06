<?php

namespace App\DataTables;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScheduleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('appointment_time',function($query){
            $date = Carbon::create($query->appointment); 
            return $date->isoFormat("HH:mm");
        })
        ->addColumn('appointment_date',function($query){
            $date = Carbon::create($query->appointment); 
            return $date->isoFormat("DD-MM-YY");
        })
        
        ->addColumn('action', function($query){
            $showBtn = "<a class='btn btn-info' href='".route("admin.schedule.show",$query->id)."'><i class='fa-solid fa-circle-info'></i> </a> &emsp;"; 
            $updateBtn = "<a class='btn btn-primary' href='".route("admin.doctor.edit",$query->id)."'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;"; 
            return $showBtn.$updateBtn;
        })
        ->addColumn('status', function ($query) {
            $types = array();
            if($query->status == "pending") {
                $types = [
                    "canceled" => "Canceled",
                        "pending" => "Pending",
                        "confirmed" => "Confirmed",
                    ];
                }
                else if($query->status == "canceled"){
                    $types = [
                        "canceled" => "Canceled",
                        "pending" => "Pending",
                    ];
                } 
                else if($query->status == "confirmed"){
                    $types = [
                        "confirmed" => "Confirmed",
                        "completed" => "Completed",
                        "canceled" => "Canceled",
                    ];
                }
                else $types = [
                    "completed" => "Completed",
                ]; ;
                $typesHTML = "";
                foreach ($types as $key => $value) {
                    if ($key == $query->status) $typesHTML .= "<option selected value='$key'> $value </option>";
                    else $typesHTML .= "<option  value='$key'> $value </option>";
                };
                return "<div class=' form-group'><select data-status='$query->status' data-user-phone='".$query->user->phone."'data-name='schedule-status' data-url='".route("admin.schedule.update-status",[$query->id])."' data-id='$query->id' class='status  select-status select-status-$query->id form-control'>" . $typesHTML . "</select> </div>";
            })
            ->setRowId('id')
            ->filterColumn("appointment_date", function ($query, $keyWord) {
                return $query->whereDate("appointment",$keyWord);
            })
            ->rawColumns(["action","status","appointment_time","appointment_date"]);
           
        }
        
        /**
         * Get the query source of dataTable.
         */
    public function query(Schedule $model): QueryBuilder
    {
        return $model->where("status",$this->status)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('schedule-table')
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
            Column::make('doctor_id'),
            Column::make('appointment_time'),
            Column::make('appointment_date'),
            Column::computed('status'),
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
        return 'Schedule_' . date('YmdHis');
    }
}
