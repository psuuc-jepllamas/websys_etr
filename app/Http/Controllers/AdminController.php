<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;
use App\Models\Admin;

class AdminController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Fullname' => 'required|string|max:255',
            'username' => 'required|string|unique:admin,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Admin::create([
            'Fullname' => $request->input('Fullname'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now login.');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid Credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard(Request $request)
    {
        try {
            // Get year and month from query parameters
            $selectedYear = $request->query('year', now()->year);
            $selectedMonth = $request->query('month', null);
            
            // Validate year and month
            if (!in_array($selectedYear, range(2025, 2030))) {
                $selectedYear = now()->year;
            }
            if ($selectedMonth && !in_array($selectedMonth, range(1, 12))) {
                $selectedMonth = null;
            }

            // Build queries for total counts
            $undergraduateQuery = DB::table('undergraduates')->whereYear('ordate', $selectedYear);
            $graduateQuery = DB::table('graduates')->whereYear('ordate', $selectedYear);

            if ($selectedMonth) {
                $undergraduateQuery->whereMonth('ordate', $selectedMonth);
                $graduateQuery->whereMonth('ordate', $selectedMonth);
            }

            $undergraduateCount = $undergraduateQuery->count();
            $graduateCount = $graduateQuery->count();

            // Fetch monthly counts for charts
            $undergraduateMonthlyCounts = DB::table('undergraduates')
                ->select(DB::raw('MONTH(ordate) as month, COUNT(*) as count'))
                ->whereYear('ordate', $selectedYear)
                ->groupBy(DB::raw('MONTH(ordate)'))
                ->pluck('count', 'month')
                ->toArray();
            $undergraduateMonthlyCounts = array_replace(
                array_fill(1, 12, 0),
                $undergraduateMonthlyCounts
            );

            $graduateMonthlyCounts = DB::table('graduates')
                ->select(DB::raw('MONTH(ordate) as month, COUNT(*) as count'))
                ->whereYear('ordate', $selectedYear)
                ->groupBy(DB::raw('MONTH(ordate)'))
                ->pluck('count', 'month')
                ->toArray();
            $graduateMonthlyCounts = array_replace(
                array_fill(1, 12, 0),
                $graduateMonthlyCounts
            );

            // Fetch recent submissions
            $recentUndergraduates = DB::table('undergraduates')
                ->select(
                    'id',
                    'fullname',
                    'course',
                    'ordate',
                    DB::raw('"Undergraduate" as type'),
                    DB::raw('CONCAT("TC-", course, "-", id, "-UG-", YEAR(ordate)) as control_no')
                )
                ->orderBy('ordate', 'desc')
                ->take(10);

            $recentGraduates = DB::table('graduates')
                ->select(
                    'id',
                    'fullname',
                    'course',
                    'ordate',
                    DB::raw('"Graduate" as type'),
                    DB::raw('CONCAT("TC-", course, "-", id, "-G-", YEAR(ordate)) as control_no')
                )
                ->orderBy('ordate', 'desc')
                ->take(10);

            $recentSubmissions = $recentUndergraduates
                ->union($recentGraduates)
                ->orderBy('ordate', 'desc')
                ->take(10)
                ->get();

            // Fetch duplicate attempts
            $duplicateAttempts = DB::table('duplicate_attempts')
                ->orderBy('attempted_at', 'desc')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'undergraduateCount',
                'graduateCount',
                'undergraduateMonthlyCounts',
                'graduateMonthlyCounts',
                'selectedYear',
                'selectedMonth',
                'recentSubmissions',
                'duplicateAttempts'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard counts: ' . $e->getMessage());
            return view('admin.dashboard', [
                'undergraduateCount' => 0,
                'graduateCount' => 0,
                'undergraduateMonthlyCounts' => array_fill(1, 12, 0),
                'graduateMonthlyCounts' => array_fill(1, 12, 0),
                'recentSubmissions' => collect([]),
                'duplicateAttempts' => collect([]),
                'selectedYear' => now()->year,
                'selectedMonth' => null,
                'error' => 'Failed to load dashboard data. Please try again.'
            ]);
        }
    }

    public function records(Request $request)
    {
        try {
            $selectedYearLevel = $request->query('year_level', '');
            $undergradCourse = $request->query('undergrad_course', '');

            Log::info('Undergraduate Filters', [
                'year_level' => $selectedYearLevel,
                'undergrad_course' => $undergradCourse
            ]);

            $undergradCourses = DB::table('undergraduates')
                ->distinct()
                ->pluck('course')
                ->sort()
                ->values()
                ->toArray();

            $studentsQuery = DB::table('undergraduates');
            if ($selectedYearLevel !== '') {
                $studentsQuery->where('yearlevel', $selectedYearLevel);
            }
            if ($undergradCourse !== '') {
                $studentsQuery->where('course', $undergradCourse);
            }
            $students = $studentsQuery->get();

            Log::info('Undergraduate Records Count', ['count' => $students->count()]);

            return view('admin.studentrecords', compact(
                'students',
                'undergradCourses',
                'selectedYearLevel',
                'undergradCourse'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching student records: ' . $e->getMessage());
            return redirect()->route('admin.studentrecords')->with('error', 'Failed to load student records. Please try again.');
        }
    }

    public function recordsGraduate(Request $request)
    {
        try {
            $gradCourse = $request->query('grad_course', '');

            Log::info('Graduate Filters', [
                'grad_course' => $gradCourse
            ]);

            $gradCourses = DB::table('graduates')
                ->distinct()
                ->pluck('course')
                ->sort()
                ->values()
                ->toArray();

            $gradStudentsQuery = DB::table('graduates');
            if ($gradCourse !== '') {
                $gradStudentsQuery->where('course', $gradCourse);
            }
            $gradstudents = $gradStudentsQuery->get();

            Log::info('Graduate Records Count', ['count' => $gradstudents->count()]);

            return view('admin.studentrecordsgraduate', compact(
                'gradstudents',
                'gradCourses',
                'gradCourse'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching graduate student records: ' . $e->getMessage());
            return redirect()->route('admin.studentrecordsgraduate')->with('error', 'Failed to load graduate student records. Please try again.');
        }
    }

    public function printCredential($id, $type)
    {
        try {
            if ($type === 'undergrad') {
                $table = 'undergraduates';
                $controlNoSuffix = 'UG';
                $template = 'pdf.undergrad';
            } elseif ($type === 'graduates') {
                $table = 'graduates';
                $controlNoSuffix = 'G';
                $template = 'pdf.grad';
            } else {
                return redirect()->back()->with('error', 'Invalid credential type.');
            }

            $student = DB::table($table)->where('id', $id)->first();

            if (!$student) {
                return redirect()->back()->with('error', 'Student record not found.');
            }

            $orDate = Carbon::parse($student->ordate);
            $dayOrdinal = $orDate->day . $this->getOrdinalSuffix($orDate->day);
            $monthYear = strtoupper($orDate->format('F, Y'));

            $controlNo = "TC-{$student->course}-{$student->id}-{$controlNoSuffix}-{$orDate->year}";

            $data = [
                'controlNo' => $controlNo,
                'fullname' => $student->fullname,
                'address' => $student->address,
                'yearLevel' => $type === 'undergrad' ? $student->yearlevel : '',
                'course' => $student->course,
                'dayOrdinal' => $dayOrdinal,
                'monthYear' => $monthYear,
            ];

            return Pdf::view($template, $data)
                ->format('A4')
                ->name("{$controlNo}.pdf")
                ->download();
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate PDF. Please try again.');
        }
    }

    public function printRecentData(Request $request)
    {
        try {
            $recentPeriod = $request->query('recent_period', 'day');
            $recentMonth = $request->query('recent_month', now()->month);
            $recentYear = $request->query('recent_year', now()->year);

            if (!in_array($recentPeriod, ['day', 'week', 'month'])) {
                $recentPeriod = 'day';
            }
            if (!in_array($recentYear, range(2025, 2030))) {
                $recentYear = now()->year;
            }
            if ($recentPeriod == 'month' && !in_array($recentMonth, range(1, 12))) {
                $recentMonth = now()->month;
            }

            $recentUndergraduates = DB::table('undergraduates')
                ->select([
                    'id',
                    'fullname',
                    'course',
                    'ordate',
                    DB::raw('"Undergraduate" as type'),
                    DB::raw('CONCAT("TC-", course, "-", id, "-UG-", YEAR(ordate)) as control_no')
                ]);
            $recentGraduates = DB::table('graduates')
                ->select([
                    'id',
                    'fullname',
                    'course',
                    'ordate',
                    DB::raw('"Graduate" as type'),
                    DB::raw('CONCAT("TC-", course, "-", id, "-G-", YEAR(ordate)) as control_no')
                ]);

            if ($recentPeriod == 'day') {
                $recentUndergraduates->whereDate('ordate', now()->toDateString());
                $recentGraduates->whereDate('ordate', now()->toDateString());
                $filterLabel = 'Today (' . now()->format('F d, Y') . ')';
            } elseif ($recentPeriod == 'week') {
                $recentUndergraduates->whereBetween('ordate', [now()->startOfWeek(), now()->endOfWeek()]);
                $recentGraduates->whereBetween('ordate', [now()->startOfWeek(), now()->endOfWeek()]);
                $filterLabel = 'This Week (' . now()->startOfWeek()->format('F d') . ' - ' . now()->endOfWeek()->format('F d, Y') . ')';
            } elseif ($recentPeriod == 'month') {
                $recentUndergraduates->whereYear('ordate', $recentYear)->whereMonth('ordate', $recentMonth);
                $recentGraduates->whereYear('ordate', $recentYear)->whereMonth('ordate', $recentMonth);
                $filterLabel = date('F', mktime(0, 0, 0, $recentMonth, 1)) . ' ' . $recentYear;
            }

            $recentSubmissions = $recentUndergraduates
                ->union($recentGraduates)
                ->orderBy('ordate', 'desc')
                ->get();

            $pdfName = 'recent-data-' . str_replace(' ', '-', strtolower($filterLabel)) . '.pdf';
            return Pdf::view('pdf.recent-data', [
                'submissions' => $recentSubmissions,
                'filterLabel' => $filterLabel,
                'generatedAt' => now()->format('F d, Y H:i')
            ])
                ->format('A4')
                ->name($pdfName)
                ->download();
        } catch (\Exception $e) {
            Log::error('Error generating recent data PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate PDF. Please try again.');
        }
    }

    public function markDuplicateAttempt(Request $request, $id)
    {
        try {
            DB::table('duplicate_attempts')
                ->where('id', $id)
                ->update(['read_at' => now(), 'updated_at' => now()]);

            return redirect()->route('admin.dashboard')->with('success', 'Duplicate attempt marked as read.');
        } catch (\Exception $e) {
            Log::error('Error marking duplicate attempt as read: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to mark duplicate attempt as read.');
        }
    }

    private function getOrdinalSuffix($day)
    {
        if (!in_array(($day % 100), [11, 12, 13])) {
            switch ($day % 10) {
                case 1:
                    return 'ST';
                case 2:
                    return 'ND';
                case 3:
                    return 'RD';
            }
        }
        return 'TH';
    }
}