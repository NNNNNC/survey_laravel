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
        $offices = Office::all(); // Fetch all offices for filtering
        $totalSurveys = Survey::count(); // Total number of surveys

        return $content
            ->title('Dashboard')
            ->description('Survey Analytics')
            ->row(view('admin.dashboard', compact('offices', 'totalSurveys')));
    }
    public function surveyDataByOffice(Request $request)
    {
        $officeId = $request->input('office_id');

        $query = DB::table('surveys')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id');

        if (!empty($officeId)) {
            $query->where('offices.id', $officeId);
        }

        $totalResponses = $query->count();

        // Compute overall satisfaction
        $overallSatisfaction = DB::table('surveys')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id')
            ->selectRaw("ROUND((AVG((SQD0 + SQD1 + SQD2 + SQD3 + SQD4 + SQD5 + SQD6 + SQD7 + SQD8 + awareness + visibility + helpfulness) / 12.0) / 5.0) * 100, 2) as overall_satisfaction")
            ->whereBetween('awareness', [1, 4])
            ->whereBetween('visibility', [1, 4])
            ->whereBetween('helpfulness', [1, 3])
            ->whereBetween('SQD0', [1, 5])
            ->whereBetween('SQD1', [1, 5])
            ->whereBetween('SQD2', [1, 5])
            ->whereBetween('SQD3', [1, 5])
            ->whereBetween('SQD4', [1, 5])
            ->whereBetween('SQD5', [1, 5])
            ->whereBetween('SQD6', [1, 5])
            ->whereBetween('SQD7', [1, 5])
            ->whereBetween('SQD8', [1, 5]);

        if (!empty($officeId)) {
            $overallSatisfaction->where('offices.id', $officeId);
        }

        $overallSatisfaction = $overallSatisfaction->value('overall_satisfaction');

        // Count total males and females separately
        $maleCount = DB::table('surveys')
            ->where('sex', 'male')
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->count();

        $femaleCount = DB::table('surveys')
            ->where('sex', 'female')
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->count();

        // Get age distribution (combined for all respondents)
        $ageDistribution = [
            '<20'   => DB::table('surveys')->where('age', '<', 20)->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '21-30' => DB::table('surveys')->whereBetween('age', [21, 30])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '31-40' => DB::table('surveys')->whereBetween('age', [31, 40])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '41-50' => DB::table('surveys')->whereBetween('age', [41, 50])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '>51'   => DB::table('surveys')->where('age', '>', 51)->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
        ];

        return response()->json([
            'total_responses' => $totalResponses,
            'overall_satisfaction' => $overallSatisfaction ? $overallSatisfaction . '%' : 'N/A',
            'male_count' => $maleCount,
            'female_count' => $femaleCount,
            'age_distribution' => $ageDistribution
        ]);
    }
}
