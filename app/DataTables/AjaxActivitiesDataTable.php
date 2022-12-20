<?php

namespace App\DataTables;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AjaxActivitiesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @param Request $request
     * @return EloquentDataTable
     */
    public function dataTable(QueryBuilder $query,Request $request): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('price', function ($activity) use ($request) {
                return '$' . $activity->price*$request->participants;
            })
            ->addColumn('action', function ($activity) {
                return '<button class="btn btn-primary btn-sm btn-reserve" >Reservar</button>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Activity $model
     * @param Request $request
     * @return QueryBuilder
     */
    public function query(Activity $model, Request $request): QueryBuilder
    {
        return $model->newQuery()->select('id', 'title','price')
            ->whereRaw("DATE('$request->date') >= DATE(start_date) AND DATE('$request->date') <= DATE(end_date)")
            ->orderBy('ranking', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('ajaxactivities-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"header-actions d-flex justify-content-between "l<" ps-xl-75 ps-0"<"dt-action-buttons d-flex justify-content-end align-items-center break-450"<"me-1"f>B>>>t<"d-flex justify-content-between mx-2 row mb-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>')                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'AjaxActivities_' . date('YmdHis');
    }
}
