<?php
	
	namespace App\Http\Controllers;
	
	use App\ViewModels\PeopleViewModel;
	use App\ViewModels\PersonViewModel;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Http;
	
	class PeopleController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index($page = 1)
		{
			abort_if($page > 500, 204);
			
			$popularPeople = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/person/popular?page='.$page)
				->json()['results']);
			
			$peopleViewModel = new PeopleViewModel($popularPeople, $page);
			
			return view('people.index', $peopleViewModel);
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			//
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function show(int $id)
		{
			$person = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/person/'.$id)
				->json());
			
			$socials = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/person/'.$id.'/external_ids')
				->json());
			
			$credits = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/person/'.$id.'/combined_credits')
				->json());
			
			$personViewModel = new PersonViewModel($person, $socials, $credits);
			
			return view('people.show', $personViewModel);
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			//
		}
	}
