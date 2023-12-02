<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\EducationLevelController;


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

/*------- index page -------*/
Route::get('/', function () {
    return view('index');
})->name('index');
/*-------------------------------*/

/*------- sign-in page -------*/
Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');
/*-------------------------------*/

/*------- about-us page -------*/
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
/*-------------------------------*/

/*------- team page -------*/
Route::get('/team', function () {
    return view('team');
})->name('team');
/*-------------------------------*/

/*------- privacy-policy page -------*/
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');
/*-------------------------------*/

/*------- terms-of-use page -------*/
Route::get('/terms-of-use', function () {
    return view('terms-of-use');
})->name('terms-of-use');
/*-------------------------------*/

/*------- admin-sign-in page -------*/
Route::get('/admin-sign-in', [AdministratorController::class, 'showLoginForm'])->name('admin.signin');
Route::post('/admin-sign-in', [AdministratorController::class, 'processLogin']);
/*-------------------------------*/

/*------- admin-sign-up page -------*/
Route::get('/admin-sign-up', 'App\Http\Controllers\AdministratorController@showRegistrationForm')->name('admin-sign-up');
Route::post('/admin-register', 'App\Http\Controllers\AdministratorController@register')->name('admin.register');
/*-------------------------------*/

/*------- student-sign-in page -------*/
Route::get('/student-sign-in', [StudentController::class, 'showLoginForm'])->name('student.signin');
Route::post('/student-sign-in', [StudentController::class, 'processLogin']);
/*-------------------------------*/

/*------- student-sign-up page -------*/
Route::get('/student-sign-up', 'App\Http\Controllers\StudentController@showRegistrationForm')->name('student-sign-up');
Route::post('/student-register', 'App\Http\Controllers\StudentController@register')->name('student.register');
/*-------------------------------*/

/*------- tutor-sign-in page -------*/
Route::get('/tutor-sign-in', [TutorController::class, 'showLoginForm'])->name('tutor.signin');
Route::post('/tutor-sign-in', [TutorController::class, 'processLogin']);
/*-------------------------------*/

/*------- tutor-sign-up page -------*/
Route::get('/tutor-sign-up', 'App\Http\Controllers\TutorController@showRegistrationForm')->name('tutor-sign-up');
Route::post('/tutor-register', 'App\Http\Controllers\TutorController@register')->name('tutor.register');
/*-------------------------------*/

/*--------------------------------------------------- admin ---------------------------------------------------*/

Route::middleware('auth', 'checkUserRole:Administrator')->group(function () { /*--------Session for admin---------*/

    /*------- admin home page -------*/
        Route::get('/admin/home', function () {
            return view('admin.home');
        })->name('admin.home');
    /*-------------------------------*/

    /*------- Manage-payment page -------*/
    Route::get('/admin/manage-payment', [PaymentController::class, 'adminView'])->name('admin.manage-payment');
    Route::post('/admin/manage-payment', [PaymentController::class, 'adminUpdatePayment'])->name('admin.update-payment');
    Route::get('/admin/manage-payment/{studentID}', [PaymentController::class, 'adminViewDetail'])->name('admin.manage-payment-detail');
    /*-------------------------------*/

    /* ---------notify student -----------*/
    Route::get('/admin/notify-pending', [PaymentController::class, 'notifyPending'])->name('admin.notify-payment');
    /* ---------------------------------*/

    /*------- education-level page -------*/
    Route::get('/admin/education-level', [EducationLevelController::class, 'indexListEdulevel'])->name('listedulevel');
    Route::post('/admin/education-level', [EducationLevelController::class, 'create'])->name('create.edulevel');
    Route::put('/admin/education-level/{eduID}', [EducationLevelController::class, 'update'])->name('update.edulevel');
    Route::delete('/admin/education-level/{eduID}', [EducationLevelController::class, 'destroy'])->name('delete.edulevel');
    /*-------------------------------*/

    /*------- package page -------*/
    Route::get('/admin/package', [PackageController::class, 'indexListPackage'])->name('listpackage');
    Route::post('/admin/package', [PackageController::class, 'create']);
    Route::put('/admin/package/{packageID}', [PackageController::class, 'update'])->name('updatepackage');
    Route::delete('/admin/package/{packageID}', [PackageController::class, 'destroy'])->name('deletepackage');
    /*-------------------------------*/

    /*------- admin profile page -------*/
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
    Route::post('/admin/profile', [AdministratorController::class, 'updateProfile'])->name('updatedProfileAdmin');
    /*-------------------------------*/

    /*------- admin profile-edit page -------*/
    Route::get('/admin/profile-edit', function () {
        return view('admin.profile-edit');
    })->name('admin.profile-edit');
    /*-------------------------------*/

    /*------- service page -------*/
    Route::get('/admin/service', function () {
        return view('admin.service');
    })->name('admin.service');
    /*-------------------------------*/

    /*------- subject page -------*/
    Route::post('/admin/subject', [SubjectController::class, 'create'])->name('createsubject');
    Route::put('/admin/subject/{subjectID}', [SubjectController::class, 'update'])->name('updatesubject');
    Route::get('/admin/subject', [SubjectController::class, 'indexListSubject'])->name('listsubject');
    Route::delete('/admin/subject/{subjectID}', [SubjectController::class, 'destroy'])->name('deletesubject');
    /*-------------------------------*/

    /*------- subscription page -------*/
    Route::get('/admin/subscription', [SubscriptionController::class, 'adminView'])->name('admin.subscription');
    Route::get('/admin/subscription/{studentID}', [SubscriptionController::class, 'adminViewDetail'])->name('admin.subscription-details');
    /*-------------------------------*/

});

/*-------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------- student ---------------------------------------------------*/

Route::middleware('auth', 'checkUserRole:Student')->group(function () { /*--------Session for student---------*/
    
    Route::middleware(['checkSubscription'])->group(function () { /*------ Check Subscription else redirect -------- */

        Route::get('/student/home', function () {
            return view('student.home');
        })->name('student.home');

        /*------- student profile page -------*/
        Route::get('/student/profile', function () {
            return view('student.profile');
        })->name('student.profile');
        Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('updatedProfileStudent');

        /*-------------------------------*/

        /*------- student profile-edit page -------*/
        Route::get('/student/profile-edit', function () {
            return view('student.profile-edit');
        })->name('student.profile-edit');
        /*-------------------------------*/

        /*------- student schedule page -------*/
        Route::get('/student/schedule', [SubjectController::class, 'scheduleStudent']);
        /*-------------------------------*/

        /*------- student payment page -------*/
        Route::get('/student/payment', function () {
            return view('student.payment');
        })->name('student.payment');
        /*-------------------------------*/

        /*------- student payment-details page -------*/
        Route::get('/student/payment-details', function () {
            return view('student.payment-details');
        })->name('student.payment-details');
        Route::post('/student/payment-details', [PaymentController::class, 'charge']);
        /*-------------------------------*/
    
    });

    /*------- student subscription page -------*/
    Route::get('/student/subscription', [SubscriptionController::class, 'viewSubs'])->name('student.subscription');
    Route::post('/student/subscription', [SubscriptionController::class, 'addSubscription']);
    /*-------------------------------*/

});

/*---------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------- tutor ---------------------------------------------------*/

Route::middleware('auth', 'checkUserRole:Tutor')->group(function () {
    
    /*------- tutor home page -------*/
    Route::get('/tutor/home', function () {
        return view('tutor.home');
    })->name('tutor.home');
    /*-------------------------------*/

    /*------- tutor profile page -------*/
    Route::get('/tutor/profile', function () {
        return view('tutor.profile');
    })->name('tutor.profile');
    Route::post('/tutor/profile', [TutorController::class, 'updateProfile'])->name('updatedProfileTutor');
    /*-------------------------------*/

    /*------- tutor profile-edit page -------*/
    Route::get('/tutor/profile-edit', function () {
        return view('tutor.profile-edit');
    })->name('tutor.profile-edit');
    /*-------------------------------*/

    /*------- tutor schedule page -------*/
    Route::get('/tutor/schedule', function () {
        return view('tutor.schedule');
    })->name('tutor.schedule');
    /*-------------------------------*/

    /*------- tutor subscription page -------*/
    Route::get('/tutor/subscription', function () {
        return view('tutor.subscription');
    })->name('tutor.subscription');
    /*-------------------------------*/

});

/*-------------------------------------------------------------------------------------------------------------*/

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/alldata',  function () {
    return view('alldata');
}); /* Testing Only */



