<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//read
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');
//middleware isLoin
// Route::middleware('isLogin')->group(function () {
    //create
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    //update
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/update/{id}', [BookController::class, 'update'])->name('books.update');
    //delete
    Route::get('/books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');

    //categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// });

//show categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name('categories.show');

//middleware isGuest
// Route::middleware('isGuest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/handle-register', [AuthController::class, 'handleRegister'])->name('auth.handleRegister');

    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/handle-login', [AuthController::class, 'handleLogin'])->name('auth.handleLogin');
        
// });

/////////////////////////////////////////////////

//socialitte
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('GithubLogin');
 
Route::get('/auth/callback', function () {
   $user = Socialite::driver('github')->user();
   //dd($user);
   $email=($user->email);
   $db_user=User::where('email','=',$email)->first();
   if($db_user==null){
    $registeres_user=User::create([
        'name'=>$user->name,
        'email'=>$user->email,
        'password'=>Hash::make('123456'),
        'oauth_token'=>$user->token,
    ]);
        Auth::login($registeres_user);
   }else{
    Auth::login($db_user);
   }

    // $user->token
});