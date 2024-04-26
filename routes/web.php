<?php

use App\Http\Controllers\AdminDocumentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchPropertyController;
use App\Http\Controllers\BranchReportController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DivisionalReportController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\NoticeBoardDownloadsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportDownloadController;
use App\Http\Controllers\ReportGenerationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ZonalReportController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/', function () {
    //return view('auth.login');
    return redirect("/dashboard");
});

/*
|--------------------------------------------------------------------------
| Dashboards 
|--------------------------------------------------------------------------
*/





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    //Ajax call routes
    Route::post('/ajax/zone-by-divid', [ZoneController::class, 'ajax_ZonesByDivisionID']);
});



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardsController::class, 'adminIndex'])->middleware(['auth', 'verified', 'adminsonly'])->name('dashboard');
Route::prefix('admin')->middleware(['auth', 'adminsonly'])->group(function () {

    //ADMIN SETUPS
    Route::resource('/setup/divisions', DivisionController::class);
    Route::resource('/setup/zones', ZoneController::class);
    Route::resource('/setup/branches', BranchController::class);
    Route::patch('/setup/branches/{branch}/reset-password', [BranchController::class, 'resetPassword'])->name('admin.branch.resetpassword');
    Route::get('/setup/branches/{branch}/target', [BranchController::class, 'showTarget'])->name('admin.branch.showTargets');
    Route::post('/setup/branches/{branch}/create', [BranchController::class, 'storeTarget'])->name('admin.branch.resetTarget');
    Route::delete('/setup/branches/{branchtarget}/destroy', [BranchController::class, 'destroyTarget'])->name('admin.branch.destroyTarget');

    Route::resource('/setup/users', UsersController::class);
    Route::patch('/setup/users/{user}/reset-password', [UsersController::class, 'resetPassword'])->name('admin.users.resetpassword');

    //branch report view & edit
    Route::get('/branchreport/{id}/edit', [BranchReportController::class, 'adminEdit'])->name('admin.branchreport.edit');
    Route::patch('/branchreport/{branchreport}/edit', [BranchReportController::class, 'adminUpdate'])->name('admin.branchreport.update');
    Route::get('/branchreport/{branchreport}/show', [BranchReportController::class, 'adminShow'])->name('admin.branchreport.show');





    //reports
    Route::get('/reports/branchreports', [ReportGenerationController::class, 'branchReports'])->name('admin.report.branchReports');
    Route::get('/reports/ajax/reportall', [ReportDownloadController::class, 'exportBranchReports'])->name('admin.exportBranchReports');
    //Ajax call routes
    Route::post('/reports/ajax/branches-by-divid', [ReportGenerationController::class, 'ajaxBranches']);

    Route::get('/reports/attendance', [ReportGenerationController::class, 'attendanceReport'])->name('admin.report.attendanceReport');
    Route::get('/reports/ajax/attendance', [ReportDownloadController::class, 'exportAttendanceReport'])->name('admin.exportAttendanceReport');

    Route::get('/reports/finance', [ReportGenerationController::class, 'financeReport'])->name('admin.report.financeReport');
    Route::get('/reports/ajax/finance', [ReportDownloadController::class, 'exportFinanceReport'])->name('admin.exportFinanceReport');

    Route::get('/reports/branches', [ReportGenerationController::class, 'branchesReport'])->name('admin.report.branchesReport');
    Route::get('/reports/ajax/branches', [ReportDownloadController::class, 'exportBranchesReport'])->name('admin.exportBranchesReport');

    Route::get('/reports/branchproperty', [ReportGenerationController::class, 'branchPropertyReport'])->name('admin.report.branchPropertyReport');
    Route::get('/reports/ajax/branchproperty', [ReportDownloadController::class, 'exportBranchPropertyReport'])->name('admin.exportBranchPropertyReport');

    Route::get('/reports/lfu', [ReportGenerationController::class, 'lfuReport'])->name('admin.report.lfuReport');
    Route::get('/reports/ajax/lfu', [ReportDownloadController::class, 'exportLfuReport'])->name('admin.exportLfuReport');

    Route::get('/reports/zonalreports', [ReportGenerationController::class, 'zoneReports'])->name('admin.report.zoneReports');
    Route::get('/reports/ajax/zonalreports', [ReportDownloadController::class, 'exportZonalReports'])->name('admin.exportZonalReports');
    

    Route::resource('/setup/upload', AdminDocumentController::class);
});



/*
|--------------------------------------------------------------------------
| Branch Routes
|--------------------------------------------------------------------------
*/
Route::get('/branchdashboard', [DashboardsController::class, 'branchIndex'])->middleware(['auth', 'branchOnly'])->name('dashboard.branch');
Route::prefix('branch')->middleware(['auth', 'branchOnly'])->group(function () {
    Route::get('/branchreport/download', [BranchReportController::class, 'exportBranchReports'])->name('branchreport.exportBranchReports');
    Route::get('/branchreport/history', [BranchReportController::class, 'branchReportHistory'])->name('branchreport.report.history');

    Route::get('/propertyreport', [BranchPropertyController::class, 'index'])->name('propertyreport.index');
    Route::post('/propertyreport/create', [BranchPropertyController::class, 'store'])->name('propertyreport.store');

    Route::get('/report_analysis', [BranchReportController::class, 'reportAnalysis'])->name('branch.report_analysis');
    Route::post('/branches/{branch}/create', [BranchController::class, 'storeTarget'])->name('branch.resetTarget');

    //noticeboard
    Route::get('/noticedownload/notice', [NoticeBoardDownloadsController::class, 'noticeBoard'])->name('noticeboard.noticeBoard');
    Route::get('/noticedownload/downloads', [NoticeBoardDownloadsController::class, 'documentDownloads'])->name('noticeboard.documentDownloads');

    //resources
    Route::resource('/branchreport', BranchReportController::class)->except(['edit', 'update']);
});



/*
|--------------------------------------------------------------------------
| Zonal Routes
|--------------------------------------------------------------------------
*/
Route::get('/zonal/dashboard', [ZonalReportController::class, 'zonalIndex'])->middleware(['auth', 'zonalOnly'])->name('dashboard.zonal');
Route::prefix('zonal')->middleware(['auth', 'zonalOnly'])->group(function () {
    Route::get('/zone/index', [ZonalReportController::class, 'index'])->name('zonal.zone.index');
    Route::get('/zone/create', [ZonalReportController::class, 'create'])->name('zonal.zone.create');
    Route::get('/zone/{zonalreport}/show', [ZonalReportController::class, 'show'])->name('zonal.zone.show');
    Route::post('/zone/store', [ZonalReportController::class, 'store'])->name('zonal.zone.store');

    Route::get('/branch/reports', [ZonalReportController::class, 'branchReports'])->name('zonal.branch.reports');
    Route::get('/branch/reports/show', [ZonalReportController::class, 'branchReportShow'])->name('zonal.branch.show');
    Route::get('/branch/reports/show/{branchreport}/detail', [ZonalReportController::class, 'branchReportDetailsShow'])->name('zonal.branch.show.detail');
    Route::get('/branch/reports/show/{branchreport}/edit', [ZonalReportController::class, 'branchReportDetailsEdit'])->name('zonal.branch.show.edit');
    Route::patch('/branchreport/{branchreport}/edit', [BranchReportController::class, 'adminUpdate'])->name('zonal.branchreport.update');

    Route::get('/noticedownload/downloads', [NoticeBoardDownloadsController::class, 'documentDownloads'])->name('zonal.noticeboard.documentDownloads');
});



/*
|--------------------------------------------------------------------------
| Divisional Routes
|--------------------------------------------------------------------------
*/
Route::get('/divisional/dashboard', [DivisionalReportController::class, 'divisionalIndex'])->middleware(['auth', 'divisionalOnly'])->name('dashboard.divisional');
Route::prefix('divisional')->middleware(['auth', 'divisionalOnly'])->group(function () {
    Route::get('/zone/reports', [DivisionalReportController::class, 'zoneReports'])->name('divisional.zone.reports');
    Route::get('/branch/reports', [DivisionalReportController::class, 'branchReportDetails'])->name('divisional.branch.reports');
    Route::get('/branch/reports/download', [DivisionalReportController::class, 'exportBranchReports'])->name('divisional.branch.reports.download');
    Route::get('/branch/reports/show/{branchreport}/detail', [ZonalReportController::class, 'branchReportDetailsShow'])->name('divisional.branch.report.show');
    Route::get('/branch/reports/show/{branchreport}/edit', [DivisionalReportController::class, 'branchReportDetailsEdit'])->name('divisional.branch.report.edit');
    Route::patch('/branch/report/{branchreport}/edit', [BranchReportController::class, 'adminUpdate'])->name('divisional.branchreport.update');
    Route::get('/branches', [DivisionalReportController::class, 'branchesReport'])->name('divisional.branches');
    // Route::get('/zone/create', [ZonalReportController::class, 'create'])->name('zonal.zone.create');
    // Route::get('/zone/{zonalreport}/show', [ZonalReportController::class, 'show'])->name('zonal.zone.show');
    // Route::post('/zone/store', [ZonalReportController::class, 'store'])->name('zonal.zone.store');

    // Route::get('/branch/reports', [ZonalReportController::class, 'branchReports'])->name('zonal.branch.reports');
    // Route::get('/branch/reports/show', [ZonalReportController::class, 'branchReportShow'])->name('zonal.branch.show');
   
   

    Route::get('/noticedownload/downloads', [NoticeBoardDownloadsController::class, 'documentDownloads'])->name('divisional.noticeboard.documentDownloads');
});






require __DIR__ . '/auth.php';
