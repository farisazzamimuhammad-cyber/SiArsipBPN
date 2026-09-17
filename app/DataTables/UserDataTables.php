<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()

            ->addColumn('role', function (User $user) {
                $role = $user->roles->first();

                return $role
                    ? $role->display_name ?? $role->name
                    : '-';
            })

            ->addColumn('action', function (User $user) {
                return view('users.datatables.actions', compact('user'));
            })

            ->rawColumns(['action']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model
            ->newQuery()
            ->with('roles');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'pageLength' => 10,
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->orderable(false)
                ->width(50),

            Column::make('name')
                ->title('Nama'),

            Column::make('email')
                ->title('Email'),

            Column::computed('role')
                ->title('Role')
                ->searchable(false)
                ->orderable(false),

            Column::make('created_at')
                ->title('Dibuat')
                ->width(150),

            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->width(150),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}