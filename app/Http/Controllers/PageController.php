<?php


namespace App\Http\Controllers;

use App\Models\forums_posted;
use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\News;
use App\Models\User;
use App\Models\Course;
use App\Models\Events;
use App\Models\Gallery;
use App\Models\surveys_posted;
use Illuminate\Support\Str;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Livewire\Components\SurveyList;

class PageController extends Controller
{
    //user pages
    public function home(News $news, Events $events, Jobs $jobs)
    {
        if (auth()->check()) {
            $user = auth()->user();

            if (!$user->email_verified_at) {
                return view('auth.verify-email');
            }

            if ($user->user_type == 'alumni') {
                return $this->alumniHome($news, $events, $jobs, $user);
            }

            if ($user->user_type != 'alumni') {
                return $this->adminDashboard($user);
            }
        }

        return view('index');
    }

    protected function alumniHome(News $news, Events $events, Jobs $jobs, $user)
    {
        if (!$user->add_info_completed) {
            return view('auth.additional-info')->with('info', 'Please Add Your Information.');
        }

        if (!$user->survey_completed) {
            return view('auth.survey')->with('info', 'Please complete this survey.');
        }

        return view('auth.home', [
            'news' => $news->latest()->get(),
            'events' => $events->latest()->get(),
            'jobs' => $jobs->latest()->get(),
        ]);
    }


    public function addInfo()
    {
        return view('auth.additional-info');
    }



    public function news(News $news)
    {
        if (auth()->check()) {
            return view('auth.news', ['news' => $news->latest()->get()]);
        }
        return view('news');
    }

    public function events(Events $events)
    {
        if (auth()->check()) {
            return view('auth.events', ['events' => $events->latest()->get()]);
        }
        return view('events');
    }

    public function jobs(Jobs $jobs)
    {
        if (auth()->check()) {
            return view('auth.jobs', ['jobs' => $jobs->latest()->get()]);
        }
        return view('jobs');
    }

    public function survey(surveys_posted $survey_list, User $authors)
    {
        if (auth()->check()) {
            return view('auth.survey', ['survey_list' => $survey_list->get(), 'authors' => $authors->get()]);
        }
        /* return view('auth.survdwaday'); */
    }
    public function forums(forums_posted $forum_list, User $authors)
    {
        if (auth()->check()) {
            return view('auth.forums', ['forum_list' => $forum_list->get(), 'authors' => $authors->get()]);
        }
        return view('forums', ['forum_list' => $forum_list->get(), 'authors' => $authors->get()]);
    }

    public function gallery(GalleryAlbum $album)
    {
        if (auth()->check()) {
            return view('auth.gallery', ['album' => $album->latest()->get()]);
        }
        return view('gallery', ['album' => $album->latest()->get()]);
    }
    public function login()
    {
        return view('login');
    }
    public function forgotPassword()
    {
        return view('forgotpass');
    }
    public function editProfile(User $user)
    {
        return view('auth.edit-profile', ['user' => auth()->user()]);
    }


    //single pages
    public function jobsSinglePage(Jobs $jobs)
    {
        return view('auth-single-pages.jobs-single-page', ['job' => $jobs]);
    }
    public function newsSinglePage(News $news)
    {
        return view('auth-single-pages.news-single-page', ['news' => $news]);
    }
    public function eventsSinglePage(Events $events)
    {
        return view('auth-single-pages.events-single-page', ['events' => $events]);
    }
    public function gallerySinglePage(GalleryAlbum $album)
    {
        return view('auth-single-pages.gallery-single-page', ['album' => $album->latest()->get()]);
    }

    //--------------------------------ADMIN----------------------------

    //GET
    public function adminDashboard()
    {
        $user = auth()->user();
        $users = new User;
        $alumniCount = User::where('user_type', 'alumni')->count();
        $verifiedUsersCount = User::where('user_type', 'alumni')->where('survey_completed', true)->where('add_info_completed', true)->whereNotNull('email_verified_at')->count();
        $verifiedUsers = User::where('user_type', 'alumni')->where('survey_completed', true)->where('add_info_completed', true)->whereNotNull('email_verified_at')->get();

        $percentageChange = 0;
        if ($verifiedUsersCount > 0) {
            $percentageChange = ($verifiedUsersCount / $alumniCount) * 100;
        }
        $courses = Course::all();
        $employmentPercentageByCourse = 0;
        if ($verifiedUsersCount > 0) {
            $employmentPercentage = ($verifiedUsersCount / $alumniCount) * 100;
        }
        //bar alumni
        $labels = [];
        $dataAll = [];
        $dataVerified = [];
        $allAlumniCountByCourse = 0;
        $verifiedAlumniCountByCourse = 0;
        foreach ($courses as $course) {
            $allAlumniCountByCourse = 0;
            $verifiedAlumniCountByCourse = 0;

            if ($users->where('course', $course->course)->count() > 0) {
                $allAlumniCountByCourse = $users->where('course', $course->course)->count();
                $verifiedAlumniCountByCourse = $users->where('course', $course->course)->where('user_type', 'alumni')->where('survey_completed', true)->where('add_info_completed', true)->whereNotNull('email_verified_at')->count();
            }
            array_push($labels, $course->course);
            array_push($dataAll, $allAlumniCountByCourse);
            array_push($dataVerified, $verifiedAlumniCountByCourse);
        }

        //bar alumnibatch
        $alumniByBatchLabels = [];
        $employed = [];
        $unemployed = [];

        $batches = User::whereNotNull('year_graduated')->where('user_type', 'alumni')
        ->distinct()
        ->pluck('year_graduated');
 

        foreach ($batches as $batch) {
            $employedCount = 0;
            $unemployedCount = 0;

            if ($users->where('year_graduated', $batch)->count() > 0) {
                $employedCount = $users->where('employment_status', 'employed', 'self-employed')->whereNotNull('email_verified_at')->count();
                $unemployedCount = $users->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
            }
            array_push($alumniByBatchLabels, $batch);
            array_push($employed, $employedCount);
            array_push($unemployed, $unemployedCount);
        }
        // dd($unemployed);

        //bar alumnigender
        $alumniByGenderLabels = [];
        $alumniMale = [];
        $alumniFemale = [];

        foreach ($courses as $course) {
            $alumniMaleCount = 0;
            $alumniFemaleCount = 0;

            if ($users->where('course', $course->course)->count() > 0) {
                $alumniMaleCount = $users->where('gender', 'male')->whereNotNull('email_verified_at')->count();
                $alumniFemaleCount = $users->where('gender', 'female')->whereNotNull('email_verified_at')->count();
            }
            array_push($alumniByGenderLabels, $course->course);
            array_push($alumniMale, $alumniMaleCount);
            array_push($alumniFemale, $alumniFemaleCount);
        }

        //pie emp status
        $maleEmployedData = [];
        $femaleEmployedData = [];
        $maleUnemployedData = [];
        $femaleUnemployedData = [];
        $maleSelfEmployedData = [];
        $femaleSelfEmployedData = [];
        $maleEmployed = 0;
        $femaleEmployed = 0;
        $maleUnemployed = 0;
        $femaleUnemployed = 0;
        $maleSelfEmployed = 0;
        $femaleSelfEmployed = 0;

        foreach ($verifiedUsers as $alumni) {


            if ($alumni->where('employment_status', 'employed')->count() > 0) {
                $maleEmployed = $users->where('gender', 'male')->whereNotNull('email_verified_at')->count();
                $femaleEmployed = $users->where('gender', 'female')->whereNotNull('email_verified_at')->count();
            }
            if ($alumni->where('employment_status', 'unemployed')->count() > 0) {
                $maleUnemployed = $users->where('gender', 'male')->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
                $femaleUnemployed = $users->where('gender', 'female')->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
            }
            if ($alumni->where('employment_status', 'self-employed')->count() > 0) {
                $maleSelfEmployed = $users->where('gender', 'male')->whereNotNull('email_verified_at')->count();
                $femaleSelfEmployed = $users->where('gender', 'female')->whereNotNull('email_verified_at')->count();
            }
            array_push($maleEmployedData, $maleEmployed);
            array_push($femaleEmployedData, $femaleEmployed);
            array_push($maleUnemployedData, $maleUnemployed);
            array_push($femaleUnemployedData, $femaleUnemployed);
            array_push($maleSelfEmployedData, $maleSelfEmployed);
            array_push($femaleSelfEmployedData, $femaleSelfEmployed);
        }

        $data = [
            //users
            'users' => new User,
            'alumniCount' => $alumniCount,
            'verifiedAlumniCount' => $verifiedUsersCount,
            'verifiedAlumni' => User::where('user_type', 'alumni')->where('survey_completed', true)->where('add_info_completed', true)->whereNotNull('email_verified_at')->get(),
            'verifiedPercentage' => $percentageChange,
            'total_users' => User::count(),
            'male_users' => User::where('gender', 'male')->count(),
            'female_users' => User::where('gender', 'female')->count(),
            'employed_users' => User::where('employment_status', 'employed')->count(),
            'unemployed_users' => User::where('employment_status', 'unemployed')->count(),
            'allAlumniCountByCourse' => $allAlumniCountByCourse,
            'verifiedAlumniCountByCourse' => $verifiedAlumniCountByCourse,
            //alumni by verified (bar-chart)
            'labels' => $labels,
            'dataAll' => $dataAll,
            'dataVerified' => $dataVerified,

            //alumni by batch (bar-chart)
            'alumniByBatchLabels' => $alumniByBatchLabels,
            'employedByBatch' => $employed,
            'unemployedByBatch' => $unemployed,

            //alumni by gender (bar-chart)
            'alumniByGenderLabels' => $alumniByGenderLabels,
            'alumniMale' => $alumniMale,
            'alumniFemale' => $alumniFemale,

            //alumni by emp status gender
            'maleEmployedCount' => $maleEmployed,
            'femaleEmployedCount' => $femaleEmployed,
            'totalEmployedCount' => $femaleSelfEmployed + $maleEmployed,
            'maleUnemployedCount' => $maleUnemployed,
            'femaleUnemployedCount' => $femaleUnemployed,
            'totalUnemployedCount' => $femaleUnemployed + $maleUnemployed,
            'maleSelfEmployedCount' => $maleSelfEmployed,
            'femaleSelfEmployedCount' => $femaleSelfEmployed,
            'totalSelfEmployedCount' => $femaleSelfEmployed + $maleSelfEmployed,

            //employment status
            'employed' => User::where('employment_status', 'employed')->count(),
            'unemployed' => User::where('employment_status', 'unemployed')->count(),
            'selfEmployed' => User::where('employment_status', 'self-employed')->count(),

            //events
            'events' => Events::all(),
            'activeEvents' => Events::where('event_end', '>', Carbon::now())->count(),

            //course
            'course' => new Course,
            'courses' => Course::all(),
            'employmentPercentageByCourse' => $employmentPercentageByCourse,

            //course
            'jobs' => Jobs::all(),

        ];
        // dd($user->where('course', $course->course)->get());
        return view('admin.dashboard', compact('user', 'data'));
    }


    public function adminAdmins(User $user)
    {
        return view('admin.admins', ['users' => $user->latest()->get()->where('user_type', '===', 'content creator')]);
    }
    public function adminUsers(User $user)
    {
        return view('admin.users', ['users' => $user->latest()->get()->where('user_type', '===', 'alumni')]);
    }
    public function adminCourses(Course $courses, User $user)
    {
        return view('admin.courses', ['courses' => $courses->latest()->get(), 'user' => $user]);
    }
    public function adminSurvey(surveys_posted $survey_list, User $authors)
    {
        return view('admin.surveys', ['survey_list' => $survey_list->get(), 'authors' => $authors->get()]);
    }
    public function adminNews(News $news)
    {
        return view('admin.news', ['news' => $news->latest()->get()]);
    }
    public function adminEvents(Events $events)
    {
        return view('admin.events', ['events' => $events->latest()->get()]);
    }
    public function adminGallery(GalleryAlbum $galleryAlbum, Gallery $photos)
    {
        return view('admin.gallery', [
            'galleryAlbum' => $galleryAlbum
                ->where('id', '!=', 1000) // Exclude the album with ID 1000
                ->latest()
                ->get(),
            'photos' => $photos->latest()->get()
        ]);
    }

    public function adminJobs(Jobs $jobs)
    {
        return view('admin.jobs', ['jobs' => $jobs->latest()->get()]);
    }
    public function adminForums(forums_posted $forum_list, User $authors)
    {
        return view('admin.forums', ['forum_list' => $forum_list->get(), 'authors' => $authors->get()]);
    }
    public function adminAnalytics(User $user, News $news, Events $events, Jobs $jobs)
    {
        return view('admin.analytics', ['users' => $user->latest()->get()->where('user_type', '!=', 'admin'), 'news' => $news->latest()->get(), 'events' => $events->latest()->get(), 'jobs' => $jobs->latest()->get()]);
    }


    //EDIT PAGES
    public function editGalleryPage(Gallery $gallery, GalleryAlbum $album)
    {
        return view('admin.edit-gallery', ['gallery' => $gallery->where('gallery_album_id', $album->id)->get(), 'galleryItem' => $gallery->latest()->get(), 'album' => $album, 'albumItem' => $album->latest()->get()]);
    }
    public function editJobsPage(Jobs $jobs)
    {
        return view('admin.edit-jobs', ['jobs' => $jobs]);
    }
    public function editEventsPage(Events $events)
    {
        return view('admin.edit-events', ['events' => $events]);
    }
    public function editNewsPage(News $news)
    {
        return view('admin.edit-news', ['news' => $news]);
    }
    public function editCoursesPage(Course $course)
    {
        return view('admin.edit-courses', ['course' => $course]);
    }
    public function editAlumniPage(User $user)
    {
        if ($user->user_type === 'alumni') {
            return view('admin.edit-alumni', ['user' => $user]);
        } else {
            return back()->with('error', 'Hmmm? This user is not an alumni');
        }
    }

    public function editAdminPage(User $user)
    {
        if ($user->user_type !== 'alumni') {
            return view('admin.edit-admin', ['user' => $user]);
        } else {
            return back()->with('error', 'Hmmm? This user is an alumni.');
        }
    }

    public function editAdminProfile(User $user)
    {
        return view('admin.edit-profile', ['user' => auth()->user()]);
    }





    //ADD PAGES
    public function addJobsPage(Events $jobs)
    {
        return view('admin.add-jobs', ['jobs' => $jobs]);
    }
    public function addEventsPage(Events $events)
    {
        return view('admin.add-events', ['events' => $events]);
    }
    public function addNewsPage(News $news)
    {
        return view('admin.add-news', ['news' => $news, 'thumbnail' => $news->thumbnail]);
    }
    public function addGalleryPage()
    {
        return view('admin.add-gallery');
    }
    public function addAlumniPage(User $user)
    {
        $user = auth()->user();
        return view('admin.add-alumni', ['user' => $user]);
    }
    public function addCoursesPage(Course $course)
    {
        $user = auth()->user();
        return view('admin.add-courses', ['course' => $course]);
    }
    public function addAdminPage(User $user)
    {
        $user = auth()->user();
        return view('admin.add-admin', ['user' => $user]);
    }
    public function addSurveyPage()
    {
        return view('admin.add-survey');
    }
//ADMIN VIEW PAGES
public function adminViewForum(forums_posted $forum_selected, User $authors)
{
    return view('admin.view_forum', ['forum_selected' => $forum_selected, 'authors' => $authors->get()]);
}

public function viewForum(forums_posted $forum_selected)
{
    return view ('auth.view_forum', [
        'forum_selected' => $forum_selected
    ]);
}
}