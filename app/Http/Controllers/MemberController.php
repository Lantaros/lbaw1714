<?php

namespace App\Http\Controllers;
use Auth;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit(Request $request, Member $member)
    {
        //
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
        return DB::select('SELECT timestamp, community, recipient, comment, comment, event
                           FROM "notification"
                           WHERE "notification".recipient = '.$member.'
                           ORDER BY "notification".timestamp');

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
