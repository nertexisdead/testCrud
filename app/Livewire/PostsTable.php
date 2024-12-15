<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostsTable extends DataTableComponent
{
    public $model = Post::class;

    public function configure(): void
    {
        $this
            ->setPrimaryKey('id')
            ->setPerPageVisibilityDisabled()
            ->setSortingPillsDisabled()
            ->setFilterPillsDisabled()
            ->setSearchDisabled()
            ->setColumnSelectDisabled()
            ->setFilterLayout('slide-down')
            ->setTdAttributes(function (Column $column, $row, $key) {
                return [
                    'class' => 'align-middle',
                ];
            })
        ;
    }

    public function filters(): array
    {
        return [
            TextFilter::make(__('Filter: post title'), 'ptitle')
                ->config([
                    'placeholder' => __('Filter by post'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereRaw('LOWER("posts"."title") LIKE \'%' . Str::lower($value) . '%\'');
                }),
            SelectFilter::make(__('Filter: post status'), 'status')
                ->options([
                    '' => __('All'),
                    1 => __('Active'),
                    0 => __('Inactive'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '') {
                        return;
                    }

                    $builder->where('is_active', (bool)$value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('', 'is_active')
                ->format(function ($value, $row) {
                    return view('components.utils.toggle')
                        ->with('id', $row->id)
                        ->with('type', 'post')
                        ->with('checked', $value)
                        ->with(
                            'route',
                            route(
                                'posts.togglePublish',
                                [
                                    'post' => $row->id,
                                ]
                            )
                        )
                        ;
                }),
            Column::make(__('Post: title'), 'title')
                ->sortable(),
            Column::make(__('Created_at'), 'created_at')
                ->sortable()
                ->format(function ($value) {
                    return (($value) ? Carbon::parse($value)->format('d.m.Y') : '-');
                }),
            Column::make(__('Updated_at'), 'updated_at')
                ->sortable()
                ->format(function ($value) {
                    return (($value) ? Carbon::parse($value)->format('d.m.Y') : '-');
                }),
            Column::make(__('Actions'), 'id')
                ->format(function ($value, $row) {
                    return view('components.utils.actions', [
                        'item' => $row,
                        'module' => 'posts',
                        'moduleSingle' => 'post',
                    ]);
                })
        ];
    }
}
