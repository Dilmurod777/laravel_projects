<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen=false">
	<input
			wire:model.debounce.500ms="search"
			type="text"
			class="bg-gray-800 rounded-full w-64 px-4 pr-8 pl-8 py-1 text-sm focus:outline-none focus:ring"
			placeholder="Search"
			x-ref="search"
			@focus="isOpen=true"
			@keydown="isOpen=true"
			@keydown.shift.tab="isOpen=false"
			@keydown.escape.window="isOpen=false"
			@keydown.window="
				if(event.keyCode===191){
					event.preventDefault();
					$refs.search.focus();
				}
			"
	>
	
	<div class="absolute top-0">
		<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 text-gray-500 mt-2 ml-2">
			<g fill="none" stroke="#F7F7F7" stroke-linecap="round" stroke-linejoin="round">
				<path d="M11.5 11.5L8.328 8.328"/>
				<circle cx="5.5" cy="5.5" r="4"/>
			</g>
		</svg>
	</div>
	
	<div wire:loading  class="spinner top-0 right-0 mr-4 mt-3.5"></div>
	
	@if(strlen($search) >=2)
		<div
				class="absolute z-50 bg-gray-800 text-sm rounded w-64 mt-4"
				x-show.transition.opacity="isOpen"
		>
			@if($searchResults->count() > 0)
				<ul>
					@foreach($searchResults as $result)
						<li class="border-b border-gray-700">
							<a
									@if($loop->last) @keydown.tab="isOpen=false" @endif
							href="{{ route('movies.show', $result['id']) }}"
									class="block flex items-center hover:bg-gray-700 px-3 py-3 transition ease-in-out duration-150"
							>
								@if($result['poster_path'])
									<img
											class="w-8"
											src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}"
											alt="{{ $result['title'] }}">
								@else
									<img
											class="w-8"
											src="https://via.placeholder.com/50x75"
											alt="poster">
								@endif
								<span class="ml-4">{{ $result['title'] }}</span>
							</a>
						</li>
					@endforeach
				</ul>
			@else
				<div class="px-3 py-3">No Results "{{ $search }}"</div>
			@endif
		</div>
	@endif
</div>