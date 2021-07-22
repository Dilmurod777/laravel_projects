<?php
	
	namespace App\Http\Controllers;
	
	use App\ViewModels\SingleTvViewModel;
	use App\ViewModels\TvViewModel;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Http;
	
	class TvController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index()
		{
			$popularTv = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/tv/popular')
				->json()['results']);
			
			$genres = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/genre/tv/list')
				->json()['genres']);
			
			$topRatedTv = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/tv/top_rated')
				->json()['results']);
			
			$moviesViewModel = new TvViewModel($popularTv, $topRatedTv, $genres);
			
			return view('tv.index', $moviesViewModel);
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
			$tv = collect(Http::withToken(config('services.tmdb.token'))
				->get(config('services.tmdb.base_url').'/tv/'.$id.'?append_to_response=credits,videos,images')
				->json());
			
			$singleTvViewModel = new SingleTvViewModel($tv);
			
			return view('tv.show', $singleTvViewModel);
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
