<?php

namespace MarkKravchuk\StatamicActivityBook;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\Controller;
use MarkKravchuk\StatamicActivityBook\Models\ActivityLog;

class ActivityBookViewController extends Controller
{
    /**
     * Function that performs filtering based on whether the search query is provided from the UI
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        // Extracting search query from request attributes
        $search_query = $request->query('search_query');

        $logs = null;

        // Whether the search query is defined, get the entries from Laravel Eloquent Model driver
        if ($search_query) {
            $logs = ActivityLog::where('log_message', 'LIKE', "%$search_query%")->orderByDesc('id')->limit(200)->get();
        } else {
            $logs = ActivityLog::orderByDesc('id')->limit(200)->get();
        }

        // Defining the view to display and data to be shown
        return view('activity-book::show',[
            'logs' => $logs,
            'search_query' => $search_query
            ]);
    }
}
