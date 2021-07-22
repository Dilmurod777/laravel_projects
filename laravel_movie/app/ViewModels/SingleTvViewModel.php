<?php
	
	namespace App\ViewModels;
	
	use Carbon\Carbon;
	use Illuminate\Support\Collection;
	use Spatie\ViewModels\ViewModel;
	
	class SingleTvViewModel extends ViewModel
	{
		protected Collection $tv;
		
		public function __construct($tv)
		{
			$this->tv = $tv;
		}
		
		public function tv(): Collection
		{
			return $this->tv->merge([
				'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->tv['poster_path'],
				'first_air_date' => isset($this->tv['first_air_date'])
					? Carbon::parse($this->tv['first_air_date'])->format('M d, Y')
					: 'Not released yet',
				'vote_average' => $this->tv['vote_average'] * 10 .'%',
				'genres' => collect($this->tv['genres'])
					->pluck('name')
					->implode(', '),
				'crew' => collect($this->tv['credits']['crew'])->take(2),
				'cast' => collect($this->tv['credits']['cast'])
					->map(function($cast) {
						$cast['profile_path'] = isset($cast['profile_path']) && $cast['profile_path'] !== ''
							? 'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']
							: 'https://via.placeholder.com/500x500';
						return $cast;
					})
					->take(5),
				'images' => collect($this->tv['images']['backdrops'])->take(9),
			])
				->only([
					'poster_path',
					'name',
					'created_by',
					'id',
					'vote_average',
					'overview',
					'first_air_date',
					'genres',
					'images',
					'crew',
					'cast',
					'videos'
				]);
		}
	}
