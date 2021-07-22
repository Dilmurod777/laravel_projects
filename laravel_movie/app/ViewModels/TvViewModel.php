<?php
	
	namespace App\ViewModels;
	
	use Carbon\Carbon;
	use Illuminate\Support\Collection;
	use Spatie\ViewModels\ViewModel;
	
	class TvViewModel extends ViewModel
	{
		protected Collection $popularTv;
		protected Collection $topRatedTv;
		protected Collection $genres;
		
		public function __construct($popularTv, $topRatedTv, $genres)
		{
			$this->popularTv = $popularTv;
			$this->topRatedTv = $topRatedTv;
			$this->genres = $genres;
		}
		
		public function popularTv(): Collection
		{
			return $this->formatTv($this->popularTv);
		}
		
		public function topRatedTv(): Collection
		{
			return $this->formatTv($this->topRatedTv);
		}
		
		public function genres(): Collection
		{
			return $this->genres->mapWithKeys(function($genre) {
				return [$genre['id'] => $genre['name']];
			});
		}
		
		
		private function formatTv($tv)
		{
			return $tv->map(function($show) {
				$genresFormatted = collect($show['genre_ids'])
					->mapWithKeys(function($value) {
						return [$value => $this->genres()->get($value)];
					})
					->implode(', ');
				
				return collect($show)
					->merge([
						'poster_path' => 'https://images.tmdb.org/t/p/w500'.$show['poster_path'],
						'vote_average' => $show['vote_average'] * 10 .'%',
						'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
						'genres' => $genresFormatted,
					])
					->only([
						'poster_path',
						'id',
						'genres',
						'name',
						'vote_average',
						'overview',
						'first_air_date',
					]);
			});
		}
	}
