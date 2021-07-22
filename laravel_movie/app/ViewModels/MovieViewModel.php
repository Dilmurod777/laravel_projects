<?php
	
	namespace App\ViewModels;
	
	use Carbon\Carbon;
	use Illuminate\Support\Collection;
	use Spatie\ViewModels\ViewModel;
	
	class MovieViewModel extends ViewModel
	{
		protected Collection $movie;
		
		public function __construct($movie)
		{
			$this->movie = $movie;
		}
		
		public function movie(): Collection
		{
			return $this->movie->merge([
				'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path'],
				'release_date' => isset($this->movie['release_date'])
					? Carbon::parse($this->movie['release_date'])->format('M d, Y')
					: 'Not released yet',
				'vote_average' => $this->movie['vote_average'] * 10 .'%',
				'genres' => collect($this->movie['genres'])
					->pluck('name')
					->implode(', '),
				'crew' => collect($this->movie['credits']['crew'])->take(2),
				'cast' => collect($this->movie['credits']['cast'])->take(5),
				'images' => collect($this->movie['images']['backdrops'])->take(9),
			])
				->only([
					'poster_path',
					'title',
					'id',
					'vote_average',
					'overview',
					'release_date',
					'genres',
					'images',
					'crew',
					'cast',
					'videos'
				]);
		}
	}
