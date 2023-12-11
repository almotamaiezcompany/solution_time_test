<?php

namespace App\DataTables;

use App\Models\Note;
use App\Models\Notes;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('status', function ($note) {
                return ' <span class="' . $note->status->class . '">
                                       ' . $note->status->name . '
                                  </span>';
            })
            ->editColumn('show', function ($note) {
                return ' <a href="' . url('/notes/' . $note->id) . '" class="btn btn-block btn-primary">View</a>';
            })
            ->editColumn('edit', function ($note) {
                return '<a href="' . url('/notes/' . $note->id . '/edit') . '" class="btn btn-block btn-primary">Edit</a>';
            })
            ->editColumn('delete', function ($note) {
                return ' <form action="' . route('notes.destroy', $note->id) . '" method="POST">
                                   <input type="hidden" name="_method" value="DELETE">
                                    ' . csrf_field() . '
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>';
            })
            ->rawColumns(['status', 'show', 'edit', 'delete'])//->addColumn('action', 'notes.action')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Note $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notes $model)
    {
        return $model->with('user')->with('status')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('notes-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('user.name')->title('Author'),
            Column::make('title')->title('Title'),
            Column::make('content')->title('Content'),
            Column::make('applies_to_date')->title('Applies to date'),
            Column::make('status')->searchable(false),
            Column::make('note_type')->title('Note type'),
            Column::make('show')->title('')->searchable(false),
            Column::make('edit')->title('')->searchable(false),
            Column::make('delete')->title('')->searchable(false),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Notes_' . date('YmdHis');
    }
}
