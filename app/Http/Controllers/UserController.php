<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Post;

class UserController extends Controller{



    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users',
            'first_name' => 'required|max:40',
            'password' => 'required|min:6'
        ]);
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user= new User();
        $user->email=$email;
        $user->first_name=$first_name;
        $user->password=$password;
        $user->save();

        Auth::login($user);
        return redirect()->route('dashboard');
    }
    public function postSignIn(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']]))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back();

    }

    public function getLogout()
    {
    Auth::logout();
    return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' =>Auth::user()]);
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required|max:120'
        ]);
        $user= Auth::user();
        $user->first_name=$request['first_name'];
        $user->update();
        $file=$request->file('image');
        $filename = $request['first_name'].'-'.$user->id.'.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file=Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
    public function showRanking()
    {
        //$users = User::orderBy('likes', 'desc')->get();



      $users=User::all();
      $posts=Post::orderBy('likes', 'desc')->get();
       // $posts = Post::orderBy('likes', 'asc')->get();
    // $likes= Post::select('likes')->groupBy('likes')->orderBy(DB::raw('max(likes)'), 'desc')->get();

        return view('ranking', ['users' => $users, 'posts'=> $posts ]);
    }


    public function showUsers()
    {
        if(Auth::user()->email != "admin@admin.com"){
            return redirect()->back();
        }
        else {
            $users = User::all();
            return view('users.index', ['users' => $users]);
        }
    }

    public function getDeleteUser($user_id)
    {
        $user= User::where('id', $user_id)->first();

        if(Auth::user()->email != "admin@admin.com"){
            return redirect()->back();
        }
        $user->delete();
        $posts= Post::where('user_id', $user_id)->delete();
        return redirect()->route('users')->with(['message'=>'Successfully deleted user.']);
    }

    public function getHome()
    {
        if(Auth::user())
        {
            return redirect()->route('dashboard');
        }
        else
            return view('welcome');
    }

}