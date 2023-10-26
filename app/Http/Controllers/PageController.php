<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jobs;
use App\Models\News;
use App\Models\User;
use App\Models\Course;
use App\Models\Events;
use App\Models\Survey;
use App\Models\Gallery;
use Illuminate\Support\Str;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

    public function survey()
    {
        return view('auth.survey');
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

    public function forums()
    {
        if (auth()->check()) {
            return view('auth.forums');
        }
        return view('forums');
    }

    public function gallery()
    {
        if (auth()->check()) {
            return view('auth.gallery');
        }
        return view('gallery');
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
        return view('auth-single-pages.jobs-single-page', ['jobs' => $jobs->latest()->get(), 'jobsclass' => $jobs]);
    }
    public function newsSinglePage(News $news)
    {
        return view('auth-single-pages.news-single-page', ['news' => $news->latest()->get(), 'newsclass' => $news]);
    }
    public function eventsSinglePage(Events $events)
    {
        return view('auth-single-pages.events-single-page', ['events' => $events->latest()->get(), 'eventsclass' => $events]);
    }
    public function gallerySinglePage(Gallery $gallery)
    {
        return view('auth-single-pages.gallery-single-page', ['gallery' => $gallery->latest()->get(), 'galleryclass' => $gallery]);
    }

//--------------------------------ADMIN----------------------------

    //GET
    public function adminDashboard()
    {
        $user = auth()->user();
        $users = new User;
        $alumniCount = User::where('user_type', 'alumni')->count();
        $verifiedUsersCount = User::where('user_type', 'alumni')->whereNotNull('email_verified_at')->count();
    
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

        foreach ($courses as $course) {
            $allAlumniCountByCourse = 0;
            $verifiedAlumniCountByCourse = 0;

            if($users->where('course',$course->course)->count() > 0) {
                $allAlumniCountByCourse = $users->where('course',$course->course)->count();
                $verifiedAlumniCountByCourse = $users->where('course',$course->course)->whereNotNull('email_verified_at')->count();
            }
            array_push($labels, $course->course);
            array_push($dataAll, $allAlumniCountByCourse);
            array_push($dataVerified, $verifiedAlumniCountByCourse);
        }

       //bar alumnigender
       $alumniByGenderLabels = [];
       $alumniMale = [];
       $alumniFemale = [];

       foreach ($courses as $course) {    
       $alumniMaleCount = 0;
       $alumniFemaleCount = 0;

           if($users->where('course',$course->course)->count() > 0) {
               $alumniMaleCount = $users->where('gender', 'male')->whereNotNull('email_verified_at')->count();
               $alumniFemaleCount = $users->where('gender','female')->whereNotNull('email_verified_at')->count();
           }
           array_push($alumniByGenderLabels, $course->course);
           array_push($alumniMale, $alumniMaleCount);
           array_push($alumniFemale, $alumniFemaleCount);
       }

        $data = [
            //users
            'users' => new User,
            'alumniCount' => $alumniCount,
            'verifiedAlumniCount' => $verifiedUsersCount,
            'verifiedAlumni' => User::where('user_type', 'alumni')->whereNotNull('email_verified_at')->get(),
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

            //alumni by gender (bar-chart)
            'alumniByGenderLabels' => $alumniByGenderLabels,
            'alumniMale' => $alumniMale,
            'alumniFemale' => $alumniFemale,

            //employment status
            'employed' => User::where('employment_status', 'employed')->count(),
            'unemployed' => User::where('employment_status', 'unemployed')->count(),
            'selfEmployed' => User::where('employment_status', 'self-employed')->count(),

            //events
            'events' => Events::all(),
            'activeEvents' => Events::where('event_end', '>', Carbon::now())->count(),

            //course
            'courses' => Course::all(),
            'employmentPercentageByCourse' => $employmentPercentageByCourse,

            //course
            'jobs' => Jobs::all(),

        ];

        
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
    public function adminCourses(Course $courses)
    {
        return view('admin.courses', ['courses' => $courses->latest()->get()]);
    }
    public function adminSurvey(Survey $survey)
    {
        return view('admin.surveys', ['surveys' => $survey->surveyQuestions()->latest()->get()]);
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
                ->where('id', '!=', 1000)  // Exclude the album with ID 1000
                ->latest()
                ->get(),
            'photos' => $photos->latest()->get()
        ]);
    }

    public function adminJobs(Jobs $jobs)
    {
        return view('admin.jobs', ['jobs' => $jobs->latest()->get()]);
    }
    public function adminForums(User $user)
    {
        return view('admin.forums', ['surveys' => $user->latest()->get()]);
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

}