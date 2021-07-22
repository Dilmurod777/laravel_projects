<?php
	
	namespace App\ViewModels;
	
	use Illuminate\Support\Collection;
	use Spatie\ViewModels\ViewModel;
	use Carbon\Carbon;
	
	class MoviesViewModel extends ViewModel
	{
		protected Collection $popularMovies;
		protected Collection $nowPlayingMovies;
		protected Collection $genres;
		
		public function __construct($popularMovies, $nowPlayingMovies, $genres)
		{
			$this->popularMovies = $popularMovies;
			$this->nowPlayingMovies = $nowPlayingMovies;
			$this->genres = $genres;
		}
		
		public function popularMovies(): Collection
		{
			return $this->formatMovies($this->popularMovies);
		}
		
		public function nowPlayingMovies(): Collection
		{
			return $this->formatMovies($this->nowPlayingMovies);
		}
		
		public function genres(): Collection
		{
			return $this->genres->mapWithKeys(function($genre) {
				return [$genre['id'] => $genre['name']];
			});
		}
		
		private function formatMovies($movies)
		{
			return $movies->map(function($movie) {
				$genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
					return [$value => $this->genres()->get($value)];
				})->implode(', ');
				
				return collect($movie)
					->merge([
						'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
						'release_date' => isset($movie['release_date'])
							? Carbon::parse($movie['release_date'])->format('M d, Y')
							: 'Not released yet',
						'vote_average' => $movie['vote_average'] * 10 .'%',
						'genres' => $genresFormatted,
					])
					->only([
						'poster_path',
						'title',
						'id',
						'vote_average',
						'overview',
						'release_date',
						'genres'
					])
					->toArray();
			});
		}
	}
