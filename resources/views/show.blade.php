@extends('statamic::layout')
@section('title', Statamic::crumb(__('Activity Book'), __('Utilities')))
@section('wrapper_class', 'max-w-full')

@section('content')

    <header class="mb-3">
        @include('statamic::partials.breadcrumb', [
            'url' => cp_route('utilities.index'),
            'title' => __('Utilities')
        ])
        <h1>{{ __('Activity Book') }}</h1>
    </header>

    <div class="card mb-2 px-3 py-2 flex flex-row items-center justify-between">
        <form class="flex" method="GET" action="{{ cp_route('utilities.activity-book.show') }}">
            <div class="select-input-container relative">
                <input class="border-2 rounded border-grey-400 h-8 w-64" type="text"  name="search_query" value="{{$search_query}}" />
            </div>
            <button class="rounded border-2 border-grey-400 ml-2 px-1">Search</button>
        </form>
    </div>

    <div class="card p-0">
        <div class="w-full overflow-auto">
            <table class="data-table">
                <thead class="pb-1">
                <th>Date</th>
                <th>User</th>
                <th>Changes</th>
                </thead>
                <tbody>
                @foreach ($logs as $key => $log)
                    <tr>
                        <td style="min-width: 120px; vertical-align: top;">{{ $log['created_at'] }}</td>
                        <td style="min-width: 120px; vertical-align: top;">{{ $log['user'] }}</td>
                        <td class="w-full font-mono text-xs">
                            {{ $log['log_message'] }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@stop
