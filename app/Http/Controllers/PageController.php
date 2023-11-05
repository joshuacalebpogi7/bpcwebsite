<?php


namespace App\Http\Controllers;

use App\Models\forums_posted;
use App\Models\forum_replies;
use App\Models\UserJobs;
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
use App\Models\Logs;

class PageController extends Controller
{
    //user pages
    public function home(News $news, Events $events, Jobs $jobs, User $user)
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
                return $this->adminDashboard();
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
        return view('news', ['newsItem' => $news->latest()->get()]);
    }

    public function events(Events $events)
    {
        if (auth()->check()) {
            return view('auth.events', ['events' => $events->latest()->get()]);
        }
        return view('events', ['events' => $events->latest()->get()]);
    }

    public function jobs(Jobs $jobs, UserJobs $userJobs)
    {
        if (auth()->check()) {
            return view('auth.jobs', ['jobs' => $jobs->where('status', 'active')->latest()->get(), 'userJobs' => $userJobs]);
        }
    }
    public function jobsArchive(Request $request, Jobs $jobs, UserJobs $userJobs)
    {
        if (auth()->check()) {
            $selectedSort = $request->input('sort', 0); // Get the selected sort criteria (0 by default)
    
        $jobs = Jobs::query();

        if ($selectedSort == 1) {
            $jobs->orderBy('created_at', 'desc'); // Sort by newest post
        } elseif ($selectedSort == 2) {
            $jobs->orderBy('created_at', 'asc'); // Sort by oldest post
        }

            return view('auth.job-archive', ['jobs' => $jobs->where('status', 'archived')->get(), 'userJobs' => $userJobs]);
        }
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
    public function gallerySinglePage(GalleryAlbum $album, Gallery $photos)
    {
        return view('auth-single-pages.gallery-single-page', ['album' => $album, 'photos' => $photos->where('gallery_album_id', $album->id)->get()]);
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
                $verifiedAlumniCountByCourse = $users->where('course', $course->course)->where('user_type', 'alumni')->whereNotNull('email_verified_at')->count();
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
                $employedCount = $users->where('year_graduated', $batch)->whereIn('employment_status', ['employed', 'self-employed'])->whereNotNull('email_verified_at')->count();
                $unemployedCount = $users->where('year_graduated', $batch)->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
            }
            array_push($alumniByBatchLabels, $batch);
            array_push($employed, $employedCount);
            array_push($unemployed, $unemployedCount);
        }

        //bar alumnigender
        $alumniByGenderLabels = [];
        $alumniMale = [];
        $alumniFemale = [];

        foreach ($courses as $course) {
            $alumniMaleCount = 0;
            $alumniFemaleCount = 0;

            if ($users->where('course', $course->course)->count() > 0) {
                $alumniMaleCount = $users->where('course', $course->course)->where('gender', 'male')->whereNotNull('email_verified_at')->count();
                $alumniFemaleCount = $users->where('course', $course->course)->where('gender', 'female')->whereNotNull('email_verified_at')->count();
            }
            array_push($alumniByGenderLabels, $course->course);
            array_push($alumniMale, $alumniMaleCount);
            array_push($alumniFemale, $alumniFemaleCount);
        }

        //bar job related
        $courseToJobCategoryMapping = [
            'BSOM' => 'Administration',
            'BSAIS' => 'Accounting and Finance',
            'BTVTEd' => 'Teaching and Education',
            'BSIS' => 'Information Technology (IT)',
            'ACT' => 'Information Technology (IT)',
            'BSCA' => 'Administration',
        ];
        
        $jobRelatedLabels = [];
        $jobRelatedCounts = [];
        $jobUnrelatedCounts = [];
        $jobRelatedAlumni = [];
        $jobUnrelatedAlumni = [];
        $allAlumniWithJobs = [];
        
        foreach ($courses as $course) {
            $courseName = $course->course;
            
            if (array_key_exists($courseName, $courseToJobCategoryMapping)) {
                $relatedJobCategory = $courseToJobCategoryMapping[$courseName];
        
                // Find users with the current course
                $usersWithCourse = $users->where('course', $courseName);
        
                if ($usersWithCourse->count() > 0) {
                    // Check if the user's job category matches the related category
                    $jobRelatedUsers = $usersWithCourse->whereIn('category', [$relatedJobCategory])
                        ->whereIn('employment_status', ['employed', 'self-employed'])
                        ->whereNotNull('email_verified_at')
                        ->get();
        
                    // Count users with unrelated job categories
                    $jobUnrelatedUsers = User::where('course', $courseName)
                        ->whereIn('employment_status', ['employed', 'self-employed'])
                        ->whereNotNull('email_verified_at')
                        ->where('category', '!=', $relatedJobCategory)
                        ->get();
        
                    $jobRelatedCount = $jobRelatedUsers->count();
                    $jobUnrelatedCount = $jobUnrelatedUsers->count();
        
                    // Store the users in the arrays
                    array_push($jobRelatedAlumni, $jobRelatedUsers);
                    array_push($jobUnrelatedAlumni, $jobUnrelatedUsers);
                    // If you want to include all alumni with jobs, you can do it like this
                    array_push($allAlumniWithJobs, $jobRelatedUsers->merge($jobUnrelatedUsers));
                } else {
                    $jobRelatedCount = 0;
                    $jobUnrelatedCount = 0;
                }
            } else {
                $jobRelatedCount = 0;
                $jobUnrelatedCount = 0;
            }
        
            array_push($jobRelatedLabels, $courseName);
            array_push($jobRelatedCounts, $jobRelatedCount);
            array_push($jobUnrelatedCounts, $jobUnrelatedCount);
            

            
        }
        
        // Now, you can use $jobRelatedAlumni and $jobUnrelatedAlumni to access the user data for related and unrelated job categories.
        // dd($allAlumniWithJobs);
        
        

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
                $maleEmployed = $users->where('gender', 'male')->where('employment_status', 'employed')->whereNotNull('email_verified_at')->count();
                $femaleEmployed = $users->where('gender', 'female')->where('employment_status', 'employed')->whereNotNull('email_verified_at')->count();
            }
            if ($alumni->where('employment_status', 'unemployed')->count() > 0) {
                $maleUnemployed = $users->where('gender', 'male')->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
                $femaleUnemployed = $users->where('gender', 'female')->where('employment_status', 'unemployed')->whereNotNull('email_verified_at')->count();
            }
            if ($alumni->where('employment_status', 'self-employed')->count() > 0) {
                $maleSelfEmployed = $users->where('gender', 'male')->where('employment_status', 'self-employed')->whereNotNull('email_verified_at')->count();
                $femaleSelfEmployed = $users->where('gender', 'female')->where('employment_status', 'self-employed')->whereNotNull('email_verified_at')->count();
            }
            array_push($maleEmployedData, $maleEmployed);
            array_push($femaleEmployedData, $femaleEmployed);
            array_push($maleUnemployedData, $maleUnemployed);
            array_push($femaleUnemployedData, $femaleUnemployed);
            array_push($maleSelfEmployedData, $maleSelfEmployed);
            array_push($femaleSelfEmployedData, $femaleSelfEmployed);
        }
        // dd($maleSelfEmployed);

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

            //job related (bar-chart)
            'jobRelatedLabels' => $jobRelatedLabels,
            'jobRelatedCounts' => $jobRelatedCounts,
            'jobUnrelatedCounts' => $jobUnrelatedCounts,
            'jobRelatedAlumni' => $jobRelatedAlumni,
            'jobUnrelatedAlumni' => $jobUnrelatedAlumni,
            'allAlumniWithJobs' => $allAlumniWithJobs,

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

            //Logs
            'logs' => Logs::all(),

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
    public function adminSurvey(surveys_posted $survey_list, User $users)
    {
        return view('admin.surveys', ['survey_list' => $survey_list->get(), 'users' => $users->get()]);
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
    public function addForumPage(forums_posted $forums_posted)
    {
        $user = auth()->user();
        return view('admin.add-forum', ['forums_posted' => $forums_posted]);
    }
    public function addSurveyPage()
    {
        return view('admin.add-survey');
    }
//ADMIN VIEW PAGES
public function adminViewSurvey(surveys_posted $survey_selected, User $user)
{
    return view('admin.view_survey', ['survey_selected' => $survey_selected, 'user' => $user->get()]);
}

public function adminViewForum(forums_posted $forum_selected, User $authors)
{
    return view('admin.view_forum', ['forum_selected' => $forum_selected, 'authors' => $authors->get()]);
}

public function adminReplyForum(forum_replies $forum_reply_selected, User $authors)
{
    return view('admin.reply_forum', ['forum_reply_selected' => $forum_reply_selected, 'authors' => $authors->get()]);
}

public function replyForum(forum_replies $forum_reply_selected, User $authors)
{
    return view('auth.reply_forum', ['forum_reply_selected' => $forum_reply_selected, 'authors' => $authors->get()]);
}

public function adminEditForum(forums_posted $forum_selected, User $authors)
{
    return view('admin.edit_forum', ['forum_selected' => $forum_selected, 'authors' => $authors->get()]);
}

public function editForum(forums_posted $forum_selected, User $authors)
{
    return view('auth.edit_forum', ['forum_selected' => $forum_selected, 'authors' => $authors->get()]);
}


public function viewForum(forums_posted $forum_selected)
{
    return view ('auth.view_forum', [
        'forum_selected' => $forum_selected
    ]);
}
}