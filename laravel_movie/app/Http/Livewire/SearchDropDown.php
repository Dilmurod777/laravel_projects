<?php
	
	namespace App\Http\Livewire;
	
	use Illuminate\Support\Facades\Http;
	use Livewire\Component;
	
	class SearchDropDown extends Component
	{
		public string $search = '';
		
		public function render()
		{
			$searchResults = collect([]);
			
			if(strlen(trim($this->search)) >= 3) {
				$searchResults = collect(Http::withToken(config('services.tmdb.token'))
					->get(config('services.tmdb.base_url').'/search/movie?query='.$this->search)
					->json()['results']);
			}
			
			return view('livewire.search-drop-down', [
				'searchResults' => $searchResults->take(7),
			]);
		}
	}
