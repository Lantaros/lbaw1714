<?php

	namespace App\Http\Controllers;

	use App\Event;
	use App\Http\Controllers\Controller;
	use App\Member;
	use Auth;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Support\Facades\Gate;

	class EventController extends Controller
	{
		public function index(){
			$events = Event::all();
			return view('pages.events.showEvents')->with('events', $events);
		}

		public function createForm(){

			return view('pages.events.createEvent');

		}

		public function create(Request $request){
			$this->validator($request->all())->validate();

			$event = new Event();

			$event->name = $request->name;
			$event->description = $request->description;

			$event->startday = $request->startDate;
			$event->endday = $request->endDate;
			$event->starttime = $request->startTime;
			$event->endtime = $request->endTime;
			$event->country = $request->country;
			$event->address = $request->address;
			$event->city = $request->city;
			$event->ispublic = $request->visibility;
			$event->imagepath = $request->imagePath;


			$event->save();


			DB::table('event_member')->insert(
				[	'idevent' => $event->idevent,
					'idmember' => Auth::user()->idmember,
					'isadmin' => true,
				]
			);

			return redirect()->route('event', $event->idevent);
		}

		public function show(Event $event){
			return view('pages.events.event')->with('event', $event);
		}

		public function editForm(Event $event){
			return view('pages.events.editEvent')->with('event', $event);
		}

		public function edit(Request $request, Event $event){
			if (Gate::allows('update-delete-event', $event)) {
				$this->validator($request->all())->validate();

				$event->name = $request->name;
				$event->description = $request->description;

				if(isset($request->imagepath))
					$event->imagepath = $request->imagepath;

				$event->startday = $request->startDate;
				$event->endday = $request->endDate;
				$event->starttime = $request->startTime;
				$event->endtime = $request->endTime;
				$event->country = $request->country;
				$event->city = $request->city;
				$event->address = $request->address;

				$event->ispublic = $request->visibility;

				$event->save();
			}

			return view('pages.events.event')->with('event', $event);
		}


		public function delete(Event $event){

			if (Gate::allows('update-delete-event', $event)) {

				//Event::find($event->idevent)->delete();
				try {
					$event->delete();
				} catch (\Exception $e) {
					echo "<script>console.log( 'Exception deleting event: ');</script>";
				}

				return redirect()->route('homepage');
			}

			else

			 return view('pages.events.event')->with('event', $event);

		}

	protected function inviteMember(Request $request, Event $event){
			dd($request);
	}

		/**Asserts the validity of the event's data
		 * @param array $data Event's attributes present in the request
		 * @return boolean
		 */
		protected function validator(array $data) {
//			$messages = [
//				'unique' => 'That :attribue is already in use!',
//				'max'    => 'The :attribute surpassed the maximum length :max!',
//				'email.required' => 'We need to know your e-mail address!',
//
//			];


			return $validate = Validator::make($data, [
				'name' => 'required|string|max:64',
				'description' => 'required|string|max:516',
				'startDate'=> '',
				'startTime' => '',
				'endDay' => '',
				'endTime' => '',
				'ispublic'=> 'boolean',
				'address' => '',
				'lodgingLink' => '',
			]);

		}

		//Queries
		public static function upcomingPublicEvents(){
            return Event::where(
                    [
                        ['ispublic', '=', 'true'],
                        ['startday','>=', now()->toDateString()]
                    ]
                )
                ->orderBy('startday', 'ASC')
                ->limit(4)
                ->get();
		}

		public static function upcomingMemberEvents(){
				return Event::where(
								'startday','>=', now()->toDateString()
						)
						->orderBy('startday', 'ASC')
						->limit(5)
						->get();
		}

		public static function topEvents(){ //Mostrar top events, eventos com mais membros que vão
			return DB::select('SELECT count(event_member.idmember) as attendants, event.*
							FROM event_member INNER JOIN event ON event_member.idevent = event.idevent
							GROUP BY(event.idevent)
							ORDER BY attendants DESC LIMIT 2');
		}

        public static function memberTopEvents(){ //Mostrar top events, eventos com mais membros que vão
            return DB::select('SELECT count(event_member.idmember) as attendants, event.*
							FROM event_member INNER JOIN event ON event_member.idevent = event.idevent
							GROUP BY(event.idevent)
							ORDER BY attendants DESC LIMIT 4');
		}

		public static function memberManageEvents(){

			$user = Auth::id();	

			return DB::select('SELECT event.idevent, event.name, description, imagePath, startday, endday
				FROM event, event_member, member
				WHERE event.idevent = event_member.idevent AND event_member.idmember = ' . $user . ' AND event_member.isadmin = true
				GROUP BY(event.idevent)');
		}

		public static function manageEvents(){			
			
			return view('pages.events.manageEvents');

        }

        public static function searchEventByName($selectedName){
            $selected = "%" . $selectedName . "%";

            return Event::where('name','LIKE', $selected)->orderBy('startday', 'ASC')->limit(9)->get();
        }
	}
