<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About this repo

The purpose of this repository is to learn/review the basics of Laravel. Thanks to Jeffrey for offering this online course: https://laracasts.com/series/30-days-to-learn-laravel-11/

## Start/stop docker containers
https://laravel.com/docs/11.x/sail

- ./vendor/bin/sail up
- with configured alias => sail up or sail up -d
- sail stop

## rebuild containers

- sail build --no-cache
- sail up -d

## migration

- Create a new table : sail artisan make:migration
- Run migration : sail artisan migrate

## tinker

Tinker is a playground with eloquent

- exemple of creating a job object with tinker

```
➜  example-app git:(eloquent) ✗ sail artisan tinker
Psy Shell v0.12.7 (PHP 8.4.3 — cli) by Justin Hileman
> App\Models\Job::create(['title' => 'Producer', 'salary' => '65 0000']);
= App\Models\Job {#5225
    title: "Producer",
    salary: "65 0000",
    updated_at: "2025-01-28 15:16:02",
    created_at: "2025-01-28 15:16:02",
    id: 4,
  }

> `

```

- listing all jobs

```
> App\Models\Job::all()

```

- find one by id

```
> App\Models\Job::find(2)
or
$job = App\Models\Job::find(2)
= App\Models\Job {#5205
    id: 2,
    title: "Director",
    salary: "80 000",
    created_at: null,
    updated_at: null,
  }

```

- interact with a variable

```
> $job->title
= "Director"

> $job->salary
= "80 000"


```

- delete a variable

```
> $job->delete()
= true

```

## Create model

To find help : php artisan help make:model

- sail artisan make:model
- sail artisan make:model -m => to create the migration file with the model one

- to 'alias' the table =>

```
class Job extends Model
{
    protected $table = 'job_listing';
```

## Modification of a table

sail artisan make:migration update_users_table --table=users

- exemple of rename and add a new table

```
 Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstName');
            $table->string('lastName')->after('firstname');;
        });
```

## Factory

sail artisan tinker

- create 1 user

```
> App\Models\User::factory()->create()
= App\Models\User {#5244
    firstName: "Karine",
    lastName: "Konopelski",
    email: "kreiger.zachery@example.com",
    email_verified_at: "2025-01-28 20:18:06",
    #password: "$2y$12$uHRRLZz/0ODqpEHyn13U4.huXiRwPxJ/3unWTyJZQHdbPXpYT8dt6",
    #remember_token: "Qb0sPeIKyX",
    updated_at: "2025-01-28 20:18:06",
    created_at: "2025-01-28 20:18:06",
    id: 2,
  }

> 
```

- create 100 users

```
> App\Models\User::factory(100)->create()

```

## pivot table

Exemple with job_tag pivot table

- in the tag model (if specific name of table):

```
public function jobs()
    {
        return $this->belongsToMany(Job::class, relatedPivotKey: 'job_listing_id');
    }
```

- in the job model (if specific name of table):

```
 public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
```

-tiinker manipulation :

to get the first job item tags

```
 $job = App\Models\Job::first()
$job->tags
```

to attach the id 2 tag to the job item

```
$job->tags()->attach(2)
```

To refetch collection

```
$job->tags()-get()
```

to get only the title name of the collection

```
$job->tags()-get()->pluck('title')

```

## add debug bar to the project

- https://github.com/barryvdh/laravel-debugbar
- .env APP_DEBUG=true

## n+1 problem

This problem is when you get a collection without the relations. if you map on this collection and you need to use a
relation it will send a new request each time.
if you have an eager load you can prevent this and limit the number of request by charcging relations that you will use.

- add an error message when there is n+1 problem in the AppServiceProvider.php file

```
public function boot(): void
    {
//        when there is a n+1 problem it will display an error page
        Model::preventLazyLoading(true);
    }
```

to prevent from this 2 ways :

- by charging collection with relation you need

```
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->get();
    return view('jobs', [
        'jobs' => $jobs,
    ]);
});
```

- by loading relation when you are mapping the collection :

```
$postTitles = $comments->load('post')->map(function ($comment) {
	return $comment->post->title;  
});
```

## Pagination

- to paginate a collection :

```
// to have all the link to all the pages
    $jobs = Job::with('employer')->paginate(3);

// to only have 'previous / next ' page
    $jobs = Job::with('employer')->simplePaginate(3);

```

- to display the pages links :

```
    <div>
        {{ $jobs->links() }}
    </div>
```

- to edit the pagination file :

```
sail artisan vendor:publish
```

- search for 'pagination'
- choose tag laravel-pagination,  
  it will generate the view of the pagination links

```
 Copying directory [vendor/laravel/framework/src/Illuminate/Pagination/resources/views] to [resources/views/vendor/pagination] 
```

## Seeder

- to seed the db and fresh it

```
sail artisan migrate:fresh --seed
```

- Create a new seeder file

```
sail artisan make:seeder
```

- to run this specific file

```
sail artisan db:seed --class=JobSeeder
```

## Route Model Binding

Laravel can find automatically the object you looking for.

- without binding :

```
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job,
    ]);
});
```

- with binding :

```
Route::get('/jobs/{job}', function (Job $job) {
    return view('jobs.show', [
        'job' => $job,
    ]);
});
```

By default it refer to the id but we can refer to another column :

```
Route::get('/jobs/{job:slug}', function (Job $job) {
    return view('jobs.show', [
        'job' => $job,
    ]);
});
```

to see all the routes :

```
sail artisan route:List --except-vendor
```

## Route::resource

it simplify the routes of a resource.

- it replace this :

```
Route::controller(jobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/{job}', 'show');
    Route::get('/jobs/create', 'create');
    Route::post('/jobs', 'store');
    Route::get('/jobs/{job}/edit', 'edit');
    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});
```

- with this :  
  it will automatically call the methods names : index, show, create, store, edit, update, destroy

```
Route::resource('jobs', jobController::class);

```

it is possible to allow only some of these methods :

```
Route::resource('jobs', jobController::class,[
  'only'=>['index','show']
]);

or 

Route::resource('jobs', jobController::class,[
  'except'=>['index','show']
]);

```

## Authorization

- 1 inline authorization  
  exemple in jobController::edit  
  allow to access to the edit fonction if you are connected  
  AND if the auth userID is the same of the edited job

```
if (Auth::guest()) {
            return redirect('/login');
        }
        
if ($job->employer->user->isNot(Auth::user())) {
            abort(403);
        }
```

- 2 Gates  
  same as in line authorization but we use the gate :

```
// on cree une gate qui renvoit un boolean
Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
        
// On utilise ensuite la gate la ou on en a besoin. La gate laisse passer ou renvoi une 403
        Gate::authorize('edit-job', $job);

// pour lui demander d'effectuer une action si c'est bon ou si c'est refuser il faut utiliser plutot :
        if (Gate::allows('edit-job', $job)) {
        //
        };
// ou

if (Gate::denies('edit-job', $job)) {
        //
        };
```

We ll use the appServiceProvider.php file to declare the gates :

```
public function boot(): void
    {
//        when there is a n+1 problem it will display an error page
        Model::preventLazyLoading(true);

        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });
    }
```

Because the User in the Gate define will always refer to an authenticate user,   
if you are a guest user, the gate will always return false. but in certain cas it can be   
changed if we use the gate::define loike this :

```
Gate::define('edit-job', function (?User $user, Job $job) {
            return $job->employer->user->is($user);
        });
or
Gate::define('edit-job', function (User $user=null, Job $job) {
            return $job->employer->user->is($user);
        });

```

## Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
