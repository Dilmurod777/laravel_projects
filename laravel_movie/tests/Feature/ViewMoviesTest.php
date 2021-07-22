<?php
	
	namespace Tests\Feature;
	
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Foundation\Testing\WithFaker;
	use Illuminate\Support\Facades\Http;
	use Tests\TestCase;
	
	class ViewMoviesTest extends TestCase
	{
		public function test_the_main_page_shows_correct_info(): void
		{
			Http::fake([
					config('services.tmdb.base_url').'/movie/popular' => $this->fakePopularMovies(),
					config('services.tmdb.base_url').'/movie/now_playing' => $this->fakeNowPlayingMovies(),
					config('services.tmdb.base_url').'/genre/movie/list' => $this->fakeGenres(),
				]
			);
			
			$response = $this->get(route('movies.index'));
			
			$response->assertSuccessful();
			$response->assertSee('Popular Movies');
			$response->assertSee('Fake Movie');
			$response->assertSee('Now Playing');
			$response->assertSee('Now Playing Fake Movie');
			// Need to format view('index') so that no \n are in code
			// $response->assertSee('Action, Adventure, Thriller, Science Fiction');
		}
		
		private function fakePopularMovies()
		{
			return Http::response([
				'results' => [
					[
						"adult" => false,
						"backdrop_path" => "/keIxh0wPr2Ymj0Btjh4gW7JJ89e.jpg",
						"genre_ids" => [
							0 => 28,
							1 => 12,
							2 => 53,
							3 => 878,
						],
						"id" => 497698,
						"original_language" => "en",
						"original_title" => "Fake Movie",
						"overview" => "Natasha Romanoff, also known as Black Widow, confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises. Pursued by a force th
at will stop at nothing to bring her down, Natasha must deal with her history as a spy and the broken relationships left in her wake long before she became an Avenger.",
						"popularity" => 6952.15,
						"poster_path" => "/qAZ0pzat24kLdO3o8ejmbLxyOac.jpg",
						"release_date" => "2021-07-07",
						"title" => "Fake Movie",
						"video" => false,
						"vote_average" => 8,
						"vote_count" => 3002,
					]
				]
			], 200);
		}
		
		private function fakeNowPlayingMovies()
		{
			return Http::response([
				'results' => [
					[
						"adult" => false,
						"backdrop_path" => "/keIxh0wPr2Ymj0Btjh4gW7JJ89e.jpg",
						"genre_ids" => [
							0 => 28,
							1 => 12,
							2 => 53,
							3 => 878,
						],
						"id" => 497698,
						"original_language" => "en",
						"original_title" => "Now Playing Fake Movie",
						"overview" => "Natasha Romanoff, also known as Black Widow, confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises. Pursued by a force th
at will stop at nothing to bring her down, Natasha must deal with her history as a spy and the broken relationships left in her wake long before she became an Avenger.",
						"popularity" => 6952.15,
						"poster_path" => "/qAZ0pzat24kLdO3o8ejmbLxyOac.jpg",
						"release_date" => "2021-07-07",
						"title" => "Now Playing Fake Movie",
						"video" => false,
						"vote_average" => 8,
						"vote_count" => 3002,
					]
				]
			], 200);
		}
		
		private function fakeGenres()
		{
			return Http::response([
				'genres' => [
					[
						"id" => 28,
						"name" => "Action"
					],
					[
						"id" => 12,
						"name" => "Adventure"
					],
					[
						"id" => 16,
						"name" => "Animation"
					],
					[
						"id" => 35,
						"name" => "Comedy"
					],
					[
						"id" => 80,
						"name" => "Crime"
					],
					[
						"id" => 99,
						"name" => "Documentary"
					],
					[
						"id" => 18,
						"name" => "Drama"
					],
					[
						"id" => 10751,
						"name" => "Family"
					],
					[
						"id" => 14,
						"name" => "Fantasy"
					],
					[
						"id" => 36,
						"name" => "History"
					],
					[
						"id" => 27,
						"name" => "Horror"
					],
					[
						"id" => 10402,
						"name" => "Music"
					],
					[
						"id" => 9648,
						"name" => "Mystery"
					],
					[
						"id" => 10749,
						"name" => "Romance"
					],
					[
						"id" => 878,
						"name" => "Science Fiction"
					],
					[
						"id" => 10770,
						"name" => "TV Movie"
					],
					[
						"id" => 53,
						"name" => "Thriller"
					],
					[
						"id" => 10752,
						"name" => "War"
					],
					[
						"id" => 37,
						"name" => "Western"
					],
				]
			], 200);
		}
	}
