<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\City;
use App\Models\Company;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\User as User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class MainController extends Controller
{
    public function signUp(Request $request)
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $username = $request->get('username');
        $password = $request->get('password');
        $exc = $request->get('experience');
        $sallary = $request->get('sallary');
        $workSpace = $request->get('selecttype');
        $role = 'worker';
        $technology = $request->get('technology');
//        $data

        $password = crc32($password);

        $data = User::create([
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'phone' => $phone,
            'username' => $username,
            'password' => $password,
            'experience' => $exc,
            'sallary' => $sallary,
            'home' => true,
            'role'=>$role,
            'token'=>0,
            'technology' => $technology
        ]);

        $tech = Technology::whereIn('id',$technology)->get();
        return view('page.profile', ['data' => $data,'tech'=>$tech]);
    }

    public function profile(Request $req)
    {
        $data = User::first();
        $tech = Technology::all();

        return view('page.profile', ['data' => $data, 'tech' => $tech]);
    }

    public function workerSignUp()
    {
        $data = Technology::all();
//        dd($data);
        return view('page/signup/worker', compact('data'));
    }

    public function login(Request $req)
    {
        $login = $req->get('login');
        $pass = $req->get('pass');

        $pass = crc32($pass);

        $user = User::where([
            ['email', '=', $login],
            ['password', '=', $pass]
        ])->orWhere([
            ['username', '=', $login],
            ['password', '=', $pass]
        ])->first();
//        dd($user);
        if ($user != null) {
            $tech = Technology::whereIn('id',$user->technology)->get();

            return view('page.profile', ['data' => $user,'tech'=>$tech]);
        }

        $pass = $req->get('pass');
        $pass = crc32($pass);

        $company = Company::where([
            ['email', '=', $login],
            ['password', '=', $pass]])->first();
//        dd($company);
        if ($company) {

            $city = City::where('id', $company->city)->first();
            $tech = $company->technology;
            $technology = Technology::whereIn('id', $tech)->get();

            $rand = rand(mb_strlen($company->email), 200);
            $authToken = hash('md5', $rand);
            $company->update(['token' => $authToken]);

            Cookie::queue('auth', $authToken, 60 * 30);
return redirect('/company/profile');

//            return view('page.company.profile', ['data' => $company, 'city' => $city, 'technology' => $technology]);
        }
        return view('page.login');
    }

    public function getCity(Request $req)
    {

        $city = City::all();
        return response()->json([
            'city' => $city
        ]);

    }

    public function showSignUpCompany()
    {
        $city = City::all();
        $technology = Technology::all();
        return view('page.signup.company', compact('city', 'technology'));
    }

    public function companySignUp(Request $req)
    {
        $data = $req->get('technology');
        $name = $req->get('name');
        $img = $req->file('image');
        $city = $req->get('city');
        $home = $req->get('home') ?? null;
        $office = $req->get('office') ?? null;
        $worker = $req->get('worker') ?? null;
        $description = $req->get('description');
        $email = $req->get('email');
        $password = $req->get('password');

        $password = crc32($password);
        Storage::disk('public')->put('img', $img);

        $company = Company::create([
            'email' => $email,
            'password' => $password,
            'technology' => $data,
            'name' => $name,
            'city' => $city,
            'img' => $img->hashName(),
            'description' => $description,
            'worker' => $worker,
            'home' => $home,
            'office' => $office
        ]);
        $rand = rand(mb_strlen($company->email), 200);
        $authToken = hash('md5', $rand);
        $company->update(['token' => $authToken]);

        Cookie::queue('auth', $authToken, 60 * 30);
        $city = City::find($company->city);
        $technology = Technology::whereIn('id', $company->technology)->get();
        return view('page.company.profile', ['data' => $company, 'city' => $city, 'technology' => $technology]);
    }

    public function companyProfile(Request $req)
    {
        $company = $req->get('companyData');
        $city = City::find($company->city);
        $tech = $company->technology;
        $technology = Technology::whereIn('id', $tech)->get();
        $advert = $this->getComanyAdvert($req);
        return view('page.company.profile', compact('company', 'advert','city', 'technology'));
    }

    public function advert(Request $req,$id)
    {
//        dd($id);
        $advert = Advert::where('id',$id)->first();
        $company = Company::find($advert->company)->first();
        $tech = Technology::whereIn('id',$advert->technology)->get();
        $city = City::find($advert->city);
        $adverts = Advert::take(20)->get();

        return view('page.advert',compact('advert','city','company','tech','adverts'));
    }

    public function logout(Request $req)
    {
        $company = $req->get('companyData');
        $user = $req->get('userData');

        if ($user) {
            Cookie::queue('auth', '', -1);
            $user->update(['token' => '']);
        }
        if ($company) {
            Cookie::queue('auth', '', -1);
            $company->update(['token' => '']);
        }
        return view('page.login');
    }

    public function checkEmail(Request $req)
    {
        $email = $req->get('email');

        $user = User::where('email', $email)->count();
        $company = Company::where('email', $email)->count();

        return response()->json([
            'user' => $user,
            'company' => $company
        ]);

    }

    public function addAdvert(Request $req){
        $company = $req->get('companyData');
        $title = $req->get('title');
        $type = $req->get('selecttype');
        $city = $req->get('city');
        $minSallary = $req->get('min');
        $maxSallary = $req->get('max');
        $desc = $req->get('description');
        $skill = $req->get('setSkill');
        $technology = $req->get('technology');

        if($type == 'office')
        {
            $office = true;
            $home = false;
        }elseif($type == 'home')
        {
            $office = false;
            $home = true;
        }

//        dd($req->all());
        Advert::create([
             'title'=>$title,
             'office'=>$office,
             'home'=>$home,
             'city'=>$city,
             'minSallary'=>$minSallary,
             'maxSallary'=>$maxSallary,
             'description'=>$desc,
             'skills'=>$skill,
             'technology'=>$technology,
             'company'=>$company->id,
        ]);

        return redirect('company/profile#advertCompany')->with('add','Вакансію створено');
    }

    public function getComanyAdvert(Request $req){
        $company = $req->get('companyData');

        $advert = Advert::where('company',$company->id)->get();

        return $advert;

    }

    public function allAdvert(Request $req){
        $advert = Advert::all();
        return view('page.all-advert',compact('advert'));
    }
}
