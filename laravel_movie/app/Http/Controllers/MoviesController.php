<?php
	
	namespace App\Http\Controllers;
	
	use App\ViewModels\MoviesViewModel;
	use App\ViewModels\MovieViewModel;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Http;
	
	class MoviesController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index()
		{
			$popularMovies = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/movie/popular')
				->json()['results']);
			
			$genres = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/genre/movie/list')
				->json()['genres']);
			
			$nowPlayingMovies = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/movie/now_playing')
				->json()['results']);
			
			$moviesViewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres);
			
			return view('movies.index', $moviesViewModel);
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
			$movie = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/movie/'.$id.'?append_to_response=credits,videos,images')
				->json());
			
			$movieViewModel = new MovieViewModel($movie);
			
			return view('movies.show', $movieViewModel);
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
