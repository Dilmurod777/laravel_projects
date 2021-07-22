<?php
	
	namespace App\ViewModels;
	
	use Illuminate\Support\Collection;
	use Spatie\ViewModels\ViewModel;
	use Carbon\Carbon;
	use function PHPUnit\Framework\isEmpty;
	
	class PersonViewModel extends ViewModel
	{
		protected Collection $person;
		protected Collection $socials;
		protected Collection $credits;
		
		public function __construct($person, $socials, $credits)
		{
			$this->person = $person;
			$this->socials = $socials;
			$this->credits = $credits;
		}
		
		public function person(): Collection
		{
			return $this->person
				->merge([
					'birthday' => Carbon::parse($this->person['birthday'])->format('M d, Y'),
					'age' => Carbon::parse($this->person['birthday'])->age,
					'profile_path' => $this->person['profile_path']
						? 'https://image.tmdb.org/t/p/w300'.$this->person['profile_path']
						: 'https://via.placeholder.com/300x450',
				]);
		}
		
		public function socials(): Collection
		{
			return $this->socials
				->merge([
					'twitter' => $this->socials['twitter_id']
						? 'https://twitter.com/'.$this->socials['twitter_id']
						: null,
					'facebook' => $this->socials['facebook_id']
						? 'https://facebook.com/'.$this->socials['facebook_id']
						: null,
					'instagram' => $this->socials['instagram_id']
						? 'https://instagram.com/'.$this->socials['instagram_id']
						: null,
				]);
		}
		
		public function knownFor(): Collection
		{
			return collect($this->credits
				->get('cast'))
				->sortByDesc('popularity')
				->take(5)
				->map(function($movie) {
					if(isset($movie['title'])) {
						$title = $movie['title'];
					} elseif(isset($movie['name'])) {
						$title = $movie['name'];
					} else {
						$title = 'Untitled';
					}
					
					return collect($movie)
						->merge([
							'poster_path' => $movie['poster_path']
								? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
								: 'https://via.placeholder.com/185x270',
							'title' => $title,
							'linkToPage' => $movie['media_type'] === 'movie'
								? route('movies.show', $movie['id'])
								: route('tv.show', $movie['id'])
						])
						->only([
							'poster_path',
							'title',
							'id',
							'media_type',
							'linkToPage',
						]);
				});
		}
		
		public function credits(): Collection
		{
			return collect($this->credits
				->get('cast'))
				->filter(function($movie) {
					return isset($movie['title']);
				})
				->map(function($movie) {
					if(isset($movie['release_date'])) {
						$release_date = $movie['release_date'];
					} elseif(isset($movie['first_air_date'])) {
						$release_date = $movie['first_air_date'];
					} else {
						$release_date = '';
					}
					
					return collect($movie)->merge([
						'title' => $movie['title'],
						'release_date' => $release_date,
						'release_year' => isset($release_date)
							? Carbon::parse($release_date)->format('Y')
							: "Future,",
						'character' => isset($movie['character']) && $movie['character'] !== ''
							? $movie['character']
							: 'Unknown'
					]);
				})
				->sortByDesc('release_date');
		}
	}
