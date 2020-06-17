<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Answer;
use App\Models\City;
use App\Models\Company;
use App\Models\Message;
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
        $advert = Advert::where('block',false)->take(20)->get();
        $city = City::all();
        return view('page.main', compact('advert', 'city'));
    }


    public function allAdvert(Request $req)
    {

        $allCity = City::orderBy('advert', 'desc')->take(20)->get();

        if ($req->get('company')) {
            $advert = Advert::where([['company_id', $req->get('company')],['block',false]])->paginate(10);
        } else if ($req->get('mainSearch')) {
            $city = $req->get('city');
            $query = $req->get('query');
            $advert = Advert::where([['title', 'ilike', '%' . $query . '%'], ['city_id', intval($city)],['block',false]])->paginate(10);
        } else {
            $advert = Advert::where([['id', '>', 0],['block',false]])->paginate(10);
        }

        return view('page.all-advert', compact('advert', 'allCity'));
    }

    public function search(Request $req)
    {
        $filterOn = $req->get('filterOn');
        $query = $req->get('query');
        $companyData = Company::where([['name','ilike','%'.$query.'%'],['block',false]])->get();
        if ($filterOn == 'false') {
            $adverts = Advert::where([['title', 'ilike', '%' . $query . '%'],['block',false]])->get();

            $view = view('.include/advert-filter-item', ['data' => $adverts, 'forSearch' => true,'companyData'=>$companyData])->render();
            return response()->json([
                'view' => $view
            ]);
        } else {
            $city = $req->get('city');
            $space = $req->get('workspace');
            $level = $req->get('level');
            $price = $req->get('price');

            $queryText = "select id from advert where title ilike '%" . $query . "%'";

            if (!empty($city)) {
                $queryText .= " and city_id='" . $city . "'";
            }
            if (!empty($space)) {
                if ($space == 'home') {
                    $queryText .= ' and home = true';
                } else if ($space == 'office') {
                    $queryText .= ' and office = true';
                }
            }
            if (!empty($level)) {
                $queryText .= " and skills='" . $level . "'";
            }
            if (!empty($price)) {
                $queryText .= " and minsallary >'" . $price . "' ";
            }

            $queryText .= " and block = false ";

            $res = DB::select($queryText);
            $id = [];
            foreach ($res as $v) {
                array_push($id, $v->id);
            }
            $data = Advert::whereIn('id', $id)->get();

            $view = view('.include/advert-filter-item', ['data' => $data, 'forSearch' => true,'companyData'=>$companyData])->render();
            return response()->json([
                'view' => $view
            ]);
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

        if ($req->file('image') != null) {
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
        if($user->role == 'admin'){
            return redirect('/admin');
        }
        if(count($user->technology) != 0){
            $tech = Technology::whereIn('id', $user->technology)->get();
        }else{
            $tech = [];
        }
        if(empty($user->selectadvert)){
            $advert = [];
        }else{
            $advert = Advert::whereIn('id', $user->selectadvert)->paginate(5);
        }

        $answer = Answer::where('user_id',$user->id)->get();

        return view('page.profile', ['data' => $user, 'tech' => $tech, 'advert' => $advert,'answer'=>$answer]);
    }

    public function addAdvertToFavorite(Request $req)
    {

        $id = $req->get('id');
        $user = $req->get('userData');

        $selectadvert = $user->selectadvert;

        if ($selectadvert != null) {

            $exist = false;
            foreach ($selectadvert as $v) {
                if ($id == $v) {
                    $exist = true;
                }
            }


            if ($exist) {
                //code for remove select element
                $new = [];
                foreach ($selectadvert as $v) {
                    if ($id != $v) {
                        array_push($new, $v);
                    }
                }
                $user->update(['selectadvert' => $new]);
                return response()->json([
                    'add' => false,
                    'remove' => true
                ]);
            } else {
                array_push($selectadvert, $id);
                $user->update(['selectadvert' => $selectadvert]);
                return response()->json([
                    'add' => true,
                    'remove' => false
                ]);

            }

        } else {
            $user->update(['selectadvert' => [$id]]);
            return response()->json([
                'add' => true,
                'remove' => false
            ]);
        }

        return $user;
    }

    //////////////////////


    ///////////////////company
    public function allCompany(Request $req)
    {
        $companyData = Company::where('block',false)->paginate(10);
        return view('page.all-company', compact('companyData'));
    }

    public function companyPublicProfile(Request $req, $id)
    {

        $company = Company::where([['id', $id],['block',false]])->first();
        $technology = Technology::whereIn('id', $company->technology)->get();
        return view('page.company', compact('company', 'technology'));
    }


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

                if($user->block){
                    return back()->with('err', 'Не вдалося увійти,користувач заблокований');
                }else {
                    $rand = rand(mb_strlen($user->email), 200);
                    $authToken = hash('md5', $rand);
                    $user->update(['token' => $authToken]);

                    Cookie::queue('auth', $authToken, 60 * 30);

                    if($user->role == 'admin'){
                        return redirect('admin');
                    }else{
                        return redirect('worker/profile');
                    }
                }
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

                if($company->block){
                    return back()->with('err', 'Не вдалося увійти,компанія заблокована');
                }
                else{
                    $city = $company->city;
                    $tech = $company->technology;
                    $technology = Technology::whereIn('id', $tech)->get();

                    $rand = rand(mb_strlen($company->email), 200);
                    $authToken = hash('md5', $rand);
                    $company->update(['token' => $authToken]);

                    Cookie::queue('auth', $authToken, 60 * 30);

                    return redirect('/company/profile');
                }

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
        $worker = $req->get('wokers') ?? null;
        $description = $req->get('description');
        $email = $req->get('email');
        $password = $req->get('password');


        $password = crc32($password);
//        Storage::disk('public')->put('img', $img);

        $path = $req->file('image')->store('images', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');

//        dd($req->all());

        $company = Company::create([
            'email' => $email,
            'password' => $password,
            'technology' => $data,
            'name' => $name,
            'city_id' => $city,
            'img' => Storage::disk('s3')->url($path),
            'description' => $description,
            'workers' => intval($worker),
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
        $companyAnswerAdvert = Answer::where('company_id',$company->id)->get();
        return view('page.company.profile', compact('company', 'advert', 'city', 'technology', 'allCity','companyAnswerAdvert'));
    }

    public function advert(Request $req, $id)
    {
        $user = $req->get('userData');
        $advert = Advert::where([['id', $id],['block',false]])->first();
//        $company = $advert->company;
        $tech = Technology::whereIn('id', $advert->technology)->get();
        $city = $advert->city;
        $adverts = Advert::where([['company_id', $advert->company_id],['block',false]])->get();
        if ($user != null) {
            $selected = false;
            if($user->selectadvert){
                foreach ($user->selectadvert as $v) {
                    if ($v == $advert->id) {
                        $selected = true;
                    }
                }

            }
        } else {
            $selected = false;
        }
        return view('page.advert', compact('advert', 'city', 'tech', 'adverts', 'selected'));
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
            'minsallary' => $minSallary,
            'maxsallary' => $maxSallary,
            'description' => $desc,
            'skills' => $skill,
            'technology' => $technology,
            'company_id' => $company->id,
        ]);

        $checkAllAdvert = Advert::where('company_id',$company->id)->count();

        switch($checkAllAdvert){
            case 2:
                $company->update(['score'=>3]);
                break;
            case 5:
                $company->update(['score'=>5]);
                dd($company);
                break;
            case 10:
                $company->update(['score'=>7]);
                break;
            case 20:
                $company->update(['score'=>10]);
                break;
        }
        $city = City::find($city);
        $city->update(['advert' => $city->advert + 1]);

        return redirect('company/profile#advertCompany')->with('add', 'Вакансію створено');
    }

    public function getComanyAdvert(Request $req)
    {
        $company = $req->get('companyData');

        $advert = Advert::where([['company_id', $company->id],['block',false]])->get();

        return $advert;

    }

    public function getAllTech(Request $req)
    {
        $client = $req->get('userData');
        if($client == null){
            $client = $req->get('companyData');
        }
        $tech = Technology::all();
        $userChange = true;

        $view = view('include.technology', ['tech' => $tech, 'userChange' => $userChange, 'userTech' => $client->technology])->render();

        return response()->json([
            'view' => $view
        ]);
    }

    public function changeUserTechnology(Request $req)
    {
        $technology = $req->get('technology');
        $user = $req->get('userData');

        if($user == null ){
            $user = $req->get('companyData');
        }

        if (empty($technology)) {
            $technology = [];
        }

        $user->update(['technology' => $technology]);

        return back();
    }

    public function showAnswerPage(Request $req, $id)
    {
        $advert = Advert::find($id);
        return view('page.resume', compact('advert'));
    }

    public function sendAnswer(Request $req)
    {
        $company = $req->get('company');
        $advert_id = $req->get('advert_id');
        $pib = $req->get('pib');
        $email = $req->get('email');
        $sallary = $req->get('sallary');
        $phone = $req->get('phone');
        $resume = $req->get('resume');
        $user = $req->get('userData');

        $checkExistAnswer = Answer::where([['user_id',$user->id],['advert_id',$advert_id]])->get();

        if(count($checkExistAnswer) >= 1){
            return redirect('/worker/profile#anserAdvert');
        }

        $companyAnswer = Answer::where('company_id',$company)->count();
        $companyInfo = Company::where('id',$company)->first();

        if($companyInfo->score == null || $companyInfo->score == 1){
            //сетимо по кількості відповідей
              switch ($companyAnswer){
                  case 2:
                      $companyInfo->update(['score'=>3]);
                      break;
                  case 5:
                      $companyInfo->update(['score'=>5]);
                      break;
                  case 10:
                      $companyInfo->update(['score'=>7]);
                      break;
                  case 20:
                      $companyInfo->update(['score'=>10]);
                      break;
              }
        }else{
            //вибираємо середнє арефметичне
            $arf = ($companyAnswer + $companyInfo->score)/2;

            if($arf == 10){
                $companyInfo->update(['score'=>9.9]);
            }else{
                $companyInfo->update(['score'=>$arf]);
            }
        }

//        dd($companyInfo->score);

        Answer::create([
           'user_id' => $user->id,
           'advert_id'=>$advert_id,
           'company_id' => $company,
           'fullname' => $pib,
           'email' => $email,
           'sallary' => $sallary,
           'phone' => $phone,
           'resume' => $resume,
            'status'=>'Надіслано'
        ]);

        return redirect('/worker/profile#anserAdvert');

    }

    public function companyShowAnswer($id,Request $req){
        $answer = Answer::find($id);
        $client = $req->get('companyData');
        $companyCheck = true;
        $message =[];
        if($client == null){
            $client = $req->get('userData');
            if($answer->user_id != $client->id){
                return \redirect(404);
            }
        }else{
            if($answer->company_id != $client->id){
                return \redirect(404);
            }
        }
        if($client == null){
            return \redirect(404);
        }




        if($answer->status == null){
            if($req->get('companyData') != null){
                $answer->update(['status'=>"Прочитано"]);
            }
        }

        if($answer->status == 'Схваленно'){
            $message = Message::where('token',$id)->get();
        }
        return view('.page.resume',compact('answer','companyCheck','message'));
    }

    public function changeStatus(Request $req){
        $status = $req->get('status');
        $answer = $req->get('id');

        $data = Answer::find($answer);

        $data->update(['status'=>$status]);

        if($status == 'Схваленно'){
            ///create unique token for chat - answer id
            $checkExistChat = Message::where('token',$answer)->first();
            if(!$checkExistChat){
                Message::create([
                    'user_id'=>$data->user_id,
                    'company_id'=>$data->company_id,
                    'message'=>'Відповідь на вакансію позитивна,тепер Вам доступний чат.',
                    'token' => $answer,
                    'status' =>'first',
                    'advert_id'=>$data->advert_id
                ]);
            }
        }


        return redirect('/answer-show/'.$answer);
    }

    public function showPublicUserProfile($id,Request $req){
        $user = User::find($id);
        $tech = Technology::whereIn('id',$user->technology)->get();
        return view('page.user-public-profile',compact('user','tech'));
    }
}
