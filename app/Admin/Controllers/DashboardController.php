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

        // Query for total responses
        $query = DB::table('surveys')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id');

        if (!empty($officeId)) {
            $query->where('offices.id', $officeId);
        }

        $totalResponses = $query->count();

        $commentsCount = $query->whereNotNull('surveys.comments')
            ->where('surveys.comments', '!=', '')
            ->count();
        // Query for overall satisfaction
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

        $overallSatisfaction = round($overallSatisfaction->value('overall_satisfaction'));

        // Query for client type count per month
        $clientTypeData = DB::table('surveys')
            ->selectRaw('MONTH(date) as month, client_type, COUNT(*) as count')
            ->whereYear('date', 2024)
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->groupBy('month', 'client_type')
            ->orderBy('month')
            ->get();

        // Count total males and females separately
        $maleCount = DB::table('surveys')
            ->where('sex', 'male')
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->count();

        $femaleCount = DB::table('surveys')
            ->where('sex', 'female')
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->count();

        // Get age distribution
        $ageDistribution = [
            'Less than 20'   => DB::table('surveys')->where('age', '<', 20)->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '21-30' => DB::table('surveys')->whereBetween('age', [21, 30])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '31-40' => DB::table('surveys')->whereBetween('age', [31, 40])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            '41-50' => DB::table('surveys')->whereBetween('age', [41, 50])->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
            'Greater than 50'   => DB::table('surveys')->where('age', '>', 50)->when($officeId, fn($query) => $query->where('office_visited', $officeId))->count(),
        ];

        // Define mappings for the ratings
        $awarenessLabels = [

            1 => "Do not know and did not see the office’s CC",
            2 => "Knows what a CC but did not see the office’s CC",
            3 => "Learned the CC by seeing the office’s CC",
            4 => "Knows what a CC and saw the office’s CC"
        ];

        $visibilityLabels = [
            0 => "N/A ",
            1 => "Not visible",
            2 => "Difficult to see",
            3 => "Somewhat easy to see",
            4 => "Easy to see"
        ];

        $helpfulnessLabels = [
            0 => "N/A",
            1 => "Did not help",
            2 => "Somewhat helped",
            3 => "Helped very much"
        ];

        // Count values for awareness, visibility, and helpfulness
        $ratingCounts = DB::table('surveys')
            ->selectRaw("'awareness' as category, awareness as rating, COUNT(*) as count")
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId)) // Filter by office
            ->groupBy('awareness')
            ->union(
                DB::table('surveys')
                    ->selectRaw("'visibility' as category, visibility as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId)) // Filter by office
                    ->groupBy('visibility')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'helpfulness' as category, helpfulness as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId)) // Filter by office
                    ->groupBy('helpfulness')
            )
            ->orderBy('category')
            ->orderBy('rating')
            ->get();

        // Transform numerical values into descriptive strings
        $ratingCounts = $ratingCounts->map(function ($item) use ($awarenessLabels, $visibilityLabels, $helpfulnessLabels) {
            if ($item->category === 'awareness') {
                $item->rating = $awarenessLabels[$item->rating] ?? "Unknown";
            } elseif ($item->category === 'visibility') {
                $item->rating = $visibilityLabels[$item->rating] ?? "Unknown";
            } elseif ($item->category === 'helpfulness') {
                $item->rating = $helpfulnessLabels[$item->rating] ?? "Unknown";
            }
            return $item;
        });

        // Query to calculate CC satisfaction percentage
        $ccSatisfactionPercentage = DB::table('surveys')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id')
            ->selectRaw("ROUND((SUM(surveys.awareness + surveys.visibility + surveys.helpfulness) / (COUNT(surveys.id) * 11)) * 100, 2) as cc_satisfaction_percentage")
            ->whereBetween('surveys.awareness', [1, 4])
            ->whereBetween('surveys.visibility', [0, 4])
            ->whereBetween('surveys.helpfulness', [0, 3]);

        if (!empty($officeId)) {
            $ccSatisfactionPercentage->where('offices.id', $officeId);
        }

        $ccSatisfactionPercentage = round($ccSatisfactionPercentage->value('cc_satisfaction_percentage'));

        $serviceSatisfactionPercentage = DB::table('surveys')
            ->join('offices', 'surveys.office_visited', '=', 'offices.id')
            ->selectRaw("ROUND((SUM(SQD0 + SQD1 + SQD2 + SQD3 + SQD4 + SQD5 + SQD6 + SQD7 + SQD8) / (COUNT(surveys.id) * 9 * 5)) * 100, 2) as service_satisfaction_percentage");

        if (!empty($officeId)) {
            $serviceSatisfactionPercentage->where('offices.id', $officeId);
        }

        $serviceSatisfactionPercentage = round($serviceSatisfactionPercentage->value('service_satisfaction_percentage'));

        $sqdCounts = DB::table('surveys')
            ->selectRaw("'SQD0' as category, SQD0 as rating, COUNT(*) as count")
            ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
            ->groupBy('SQD0')
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD1' as category, SQD1 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD1')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD2' as category, SQD2 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD2')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD3' as category, SQD3 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD3')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD4' as category, SQD4 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD4')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD5' as category, SQD5 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD5')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD6' as category, SQD6 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD6')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD7' as category, SQD7 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD7')
            )
            ->union(
                DB::table('surveys')
                    ->selectRaw("'SQD8' as category, SQD8 as rating, COUNT(*) as count")
                    ->when($officeId, fn($query) => $query->where('office_visited', $officeId))
                    ->groupBy('SQD8')
            )
            ->orderBy('category')
            ->orderBy('rating')
            ->get();

        $emailComments = DB::table('surveys')
            ->select('email', 'comments', 'created_at')
            ->whereNotNull('comments')
            ->where('comments', '!=', '')
            ->when(!empty($officeId), fn($query) => $query->where('office_visited', $officeId)) // Filter by office
            ->orderBy('created_at', 'DESC')
            ->get();

        $serviceResponses = DB::table('surveys')
            ->join('services', 'surveys.service', '=', 'services.id')
            ->select('services.name', DB::raw('COUNT(surveys.service) AS total_response'))
            ->when(!empty($officeId), fn($query) => $query->where('surveys.office_visited', $officeId)) // Filter by office
            ->groupBy('services.name')
            ->orderByDesc('total_response')
            ->get();

        return response()->json([
            'total_responses' => $totalResponses,
            'comments_count'  => $commentsCount,
            'overall_satisfaction' => $overallSatisfaction ? $overallSatisfaction . '%' : 'N/A',
            'client_type_data' => $clientTypeData,
            'male_count' => $maleCount,
            'female_count' => $femaleCount,
            'age_distribution' => $ageDistribution,
            'rating_counts' => $ratingCounts,
            'cc_satisfaction_percentage' => $ccSatisfactionPercentage ? $ccSatisfactionPercentage . '%' : 'N/A',
            'service_satisfaction_percentage' => $serviceSatisfactionPercentage ? $serviceSatisfactionPercentage . '%' : 'N/A',
            'sqd_counts' => $sqdCounts,
            'email_comments' => $emailComments,
            'service_responses' => $serviceResponses
        ]);
    }
}
