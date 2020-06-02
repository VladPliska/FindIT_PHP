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
use Symfony\Component\HttpFoundation\File\UploadedFile;


class MainController extends Controller
{

    public function index(Request $req)
    {
        $advert = Advert::all()->take(20);
        $city = City::all();
        return view('page.main', compact('advert', 'city'));
    }


    public function allAdvert(Request $req)
    {
        $advert = Advert::all();
        $allCity = City::orderBy('advert', 'desc')->take(20)->get();

        return view('page.all-advert', compact('advert','allCity'));
    }

    public function search(Request $req)
    {
        $filterOn =$req->get('filterOn');
        $query = $req->get('query');
//        dd($filterOn);

        if($filterOn == 'false'){
            $adverts = Advert::where('title','ilike','%'.$query.'%')->get();
            return response()->json([
                'data'=>$adverts
            ]);
        }else{
            $city = $req->get('city');
            $space = $req->get('workspace');
            $level = $req->get('level');
            $price = $req->get('price');

            $queryText = "select * from advert where title ilike '%".$query."%'";

            if(!empty($city)){
                $queryText .= " and city_id='".$city."'";
            }
            if(!empty($space)){
                if($space == 'home'){
                    $queryText .= ' and home = true';
                }else if($space == 'office'){
                    $queryText .= ' and office = true';
                }
            }
            if(!empty($level)){
                $queryText .= " and skills='".$level."'";
            }
            if(!empty($price)){
                $queryText .= " and minsallary <'".$price."' "  ;
            }

            $res =  DB::select($queryText);

            dd($res);




        }

    }


    /////////////////WORKER FUNCTION
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

        $password = crc32($password);

        $rand = rand(mb_strlen($email), 200);
        $authToken = hash('md5', $rand);

        Cookie::queue('auth', $authToken, 60 * 30);

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
            'role' => $role,
            'token' => $authToken,
            'technology' => $technology
        ]);

        return redirect('worker/profile');
    }

    public function saveImgResume(Request $req)
    {
        $user = $req->get('userData');
        $resume = $req->get('resume');

        if ($req->file('img') != null) {
            $path = $req->file('image')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            $user->update([
                'img' => Storage::disk('s3')->url($path),
                'resume' => $resume
            ]);
        } else {
            $user->update([
                'resume' => $resume
            ]);
        }


        return back()->with('succ', 'Профіль оновленно');
    }

    public function workerChangePassword(Request $req)
    {
        $user = $req->get('userData');
        $oldpass = $req->get('old');
        $rep = $req->get('rep');
        $new = $req->get('new');

        $oldpass = crc32($oldpass);

        if ($oldpass != $user->password) {
            return back()->with('err', 'Старий пароль вказано не вірно');
        }
        if ($rep != $new) {
            return back()->with('err', 'Паролі не співпадають');
        }

        $new = crc32($new);

        $user->update(['pasword' => $new]);

        return redirect('worker/profile')->with('succ', 'Пароль змінено');
    }

    public function changeWorkerOtherData(Request $req)
    {
        $sallary = $req->get('sallary');
        $exp = $req->get('exp');
        $workspace = $req->get('settype');
        $user = $req->get('userData');

        if ($workspace == 'home') {
            $user->update([
                'sallary' => $sallary,
                'experience' => $exp,
                'home' => true,
                'office' => false
            ]);
        } else {
            $user->update([
                'sallary' => $sallary,
                'experience' => $exp,
                'home' => false,
                'office' => true
            ]);
        }
        return redirect('worker/profile')->with('succ', 'Додаткову інформацію змінено');
    }

    public function workerSignUp()
    {
        $data = Technology::all();
        return view('page/signup/worker', compact('data'));
    } //???????

    public function workerProfile(Request $req)
    {
        $user = $req->get('userData');
        if ($user == null) {
            return redirect('/login');
        }
        $tech = Technology::whereIn('id', $user->technology)->get();


        return view('page.profile', ['data' => $user, 'tech' => $tech]);
    }

    //////////////////////


    ///////////////////company
    ///
    public function login(Request $req)
    {
        $login = $req->get('login');
        $pass = $req->get('pass');

        $pass = crc32($pass);
        $type = $req->get('type');

        if ($type == 'worker') {
            $user = User::where([
                ['email', '=', $login],
                ['password', '=', $pass]
            ])->orWhere([
                ['username', '=', $login],
                ['password', '=', $pass]
            ])->first();
            if ($user != null) {
                $rand = rand(mb_strlen($user->email), 200);
                $authToken = hash('md5', $rand);
                $user->update(['token' => $authToken]);

                Cookie::queue('auth', $authToken, 60 * 30);

//                return view('page.profile', ['data' => $user,'tech'=>$tech]);
                return redirect('worker/profile');
            } else {

                return back()->with('err', 'Не вдалося увійти,спробуйте інший логін або пароль');
            }
        } else if ($type == 'company') {
            $pass = $req->get('pass');
            $pass = crc32($pass);

            $company = Company::where([
                ['email', '=', $login],
                ['password', '=', $pass]])->first();
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
            } else {
                return back()->with('err', 'Не вдалося увійти,спробуйте інший логін або пароль');
            }
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
//        Storage::disk('public')->put('img', $img);

        $path = $req->file('image')->store('images', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');


        $company = Company::create([
            'email' => $email,
            'password' => $password,
            'technology' => $data,
            'name' => $name,
            'city_id' => $city,
            'img' => Storage::disk('s3')->url($path),
            'description' => $description,
            'worker' => $worker,
            'home' => $home,
            'office' => $office
        ]);
        $rand = rand(mb_strlen($company->email), 200);
        $authToken = hash('md5', $rand);
        $company->update(['token' => $authToken]);

        Cookie::queue('auth', $authToken, 60 * 30);

        return redirect('/company/profile');
    }

    public function companyProfile(Request $req)
    {
        $company = $req->get('companyData');
        $tech = $company->technology;
        $city = $company->city;
        $allCity = City::all();
        $technology = Technology::whereIn('id', $tech)->get();
        $advert = $this->getComanyAdvert($req);
        return view('page.company.profile', compact('company', 'advert', 'city', 'technology', 'allCity'));
    }

    public function advert(Request $req, $id)
    {
        $advert = Advert::where('id', $id)->first();
        $company = Company::find($advert->company_id)->first();
        $tech = Technology::whereIn('id', $advert->technology)->get();
        $city = $advert->city;
        $adverts = Advert::take(20)->get();

        return view('page.advert', compact('advert', 'city', 'company', 'tech', 'adverts'));
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

    public function addAdvert(Request $req)
    {
        $company = $req->get('companyData');
        $title = $req->get('title');
        $type = $req->get('selecttype');
        $city = $req->get('city');
        $minSallary = $req->get('min');
        $maxSallary = $req->get('max');
        $desc = $req->get('description');
        $skill = $req->get('setSkill');
        $technology = $req->get('technology');

        if ($type == 'office') {
            $office = true;
            $home = false;
        } elseif ($type == 'home') {
            $office = false;
            $home = true;
        }

//        dd($req->all());
        Advert::create([
            'title' => $title,
            'office' => $office,
            'home' => $home,
            'city_id' => $city,
            'minSallary' => $minSallary,
            'maxSallary' => $maxSallary,
            'description' => $desc,
            'skills' => $skill,
            'technology' => $technology,
            'company_id' => $company->id,
        ]);

        $city = City::find($city);
        $city->update(['advert'=> $city->advert+1]);

        return redirect('company/profile#advertCompany')->with('add', 'Вакансію створено');
    }

    public function getComanyAdvert(Request $req)
    {
        $company = $req->get('companyData');

        $advert = Advert::where('company_id', $company->id)->get();

        return $advert;

    }


}
