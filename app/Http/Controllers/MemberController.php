<?php

namespace App\Http\Controllers;
use Auth;

use App\Member;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $member = Member::where("username", '=', $username)->first();
        return view('pages.members.profile')->with('member', $member);
    }

     public function authProfile()
    {
        $member = Auth::user();
        return view('pages.members.profile')->with('member', $member);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function editForm(){
        $member = Auth::user();
        return view('pages.members.editProfile')->with('member', $member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
//    		dd($request);
				//$member = Member::find($request->query->get('member'));
        $member = Auth::user();


				if (Gate::allows('edit-profile', $member)) {
            
            //$this->editValidator($request->all())->validate(); //TODO Validatior has an unknown error
            $member->name = $request->name;
            $member->birthdate = $request->birthdate;

					if($request->hasFile('eventImage')) {
						$imgType = $request->file('eventImage')->getMimeType();
						$imgType = '.' . substr($imgType, strpos($imgType, '/') + 1);

						$member->profilepicture = 'img/event/' . $member->username . $imgType;


						$request->file('eventImage')->storeAs('public/img/member', $member->username . $imgType);
					}

            $member->address = $request->address;
            $member->idcountry = Country::where('name', '=', $request->country)->first()->idcountry;
            $member->about = $request->about;
            $member->email = $request->email;
            if(isset($request->password)) 
               $member->password = $request->password;
             
            $member->save();
         }

         return view('pages.members.profile')->with('member', $member);
    }

    protected function createValidator(array $data) {

        return $validate = Validator::make($data, [
            'username' => 'required|string|min:3|max:16|unique:member',      
            'name' => 'required|string|min:3|max:50',
						'country' => 'required|string|exists:country',
            'email'=> 'required|email|max:50|unique:member',
            'password' => 'required|string|max:50|confirmed',            
        ]);
    }


    protected function editValidator(array $data) {


        $validate = Validator::make($data, [
            'name' => 'required|string|min:3|max:50',            
            'country' => 'required|string|exists:country,name',
            'email'=> 'required|email|max:50|unique:member',
            
            'birthdate'=> 'date_format:"Y-m-d"', //verificar
            'address'=> 'nullable|string|max:50',
            'about' => 'nullable|string|max:256',
            'password' => 'nullable|string|max:50|confirmed',
            
        ]);


        return $validate;
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function passResetForm(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function passReset(Request $request, Member $member)
    {
        //
    }

    public static function profileFeed($member)
    {
//        return DB::select('SELECT *
//                           FROM "notification
//                           ORDER BY "notification".timestamp');

        //    LIMIT $selectedLimit OFFSET $selectedOffset
    }

    public static function profileUpcoming($member)
    {
        $todayDate = date('Y-m-d');
        $todayHour = date('H:i:s');
        return DB::select('
                        SELECT "event".idevent, name, description, imagePath, startday, starttime, endtime
                        FROM "event", "event_member"
                        WHERE "event".idevent = "event_member".idevent AND "event_member".idmember ='.$member.'  
                         AND "event".startday >= \'' . $todayDate . ' \'                  
                        Order BY "event".startday DESC');

        //    LIMIT $selectedLimit OFFSET $selectedOffset
    }
    
    public static function profileHistory($member)
    {
        $todayDate =date('Y-m-d');
        $todayHour = date('H:i:s');
        
        return DB::select('
                        SELECT "event".idevent, name, description, imagePath, startday, endday, starttime, endtime
                        FROM "event"
                        INNER JOIN event_member
                        ON "event".idevent= "event_member".idevent AND "event_member".idmember = '.$member . '
                        WHERE "event".startday <= \'' . $todayDate . ' \'
                        Order BY "event".startday DESC');

        //    LIMIT $selectedLimit OFFSET $selectedOffset
    }

}
