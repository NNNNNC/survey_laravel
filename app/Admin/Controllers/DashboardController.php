<?php
namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Layout\Content;
use App\Models\Survey;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends AdminController
{
    public function index(Content $content)
    {
        $offices = Office::all();

        return $content
            ->title('Dashboard')
            ->description('Survey Analytics')
            ->body(view('admin.dashboard', compact('offices')));
    }

    public function surveyDataByOffice(Request $request)
    {
        $officeId = $request->input('office_id');

        $query = DB::table('surveys')
            ->selectRaw('offices.name as office_name, AVG(awareness) as avg_awareness, AVG(visibility) as avg_visibility, AVG(helpfulness) as avg_helpfulness')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id')
            ->groupBy('offices.name');

        if ($officeId) {
            $query->where('offices.id', $officeId);
        }

        return response()->json($query->get());
    }
}

