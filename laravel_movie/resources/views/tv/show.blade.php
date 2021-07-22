@extends('layouts.main')

@section('content')
	<div class="tv-info border-b border-gray-800">
		<div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
			<img src="{{ $tv['poster_path'] }}"
			     alt="{{$tv['name']}}"
			     class="w-64 md:w-96">
			
			<div class="md:ml-24">
				<h2 class="text-4xl font-semibold mt-4 md:mt-0">{{ $tv['name'] }}</h2>
				<div class="flex flex-wrap items-center text-gray-400 text-sm mt-2">
							<span>
								<svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="12" height="12">
									<path
											d="M11.045 2.011a3.345 3.345 0 00-4.792 0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345 3.345 0 00-4.792 0 3.345 3.345 0 000 4.792l5.017 4.718L11.045 6.8a3.484 3.484 0 000-4.789z"
											fill="#ed8936"/>
								</svg>
							</span>
					<span class="ml-1">{{ $tv['vote_average'] }}</span>
					<span class="mx-2">|</span>
					<span>{{ $tv['first_air_date'] }}</span>
					<span class="mx-2">|</span>
					<span>{{ $tv['genres'] }}</span>
				</div>
				
				<p class="text-gray-300 mt-8">{{ $tv['overview'] }}</p>
				
				<div class="mt-12">
					<div class="flex mt-4">
						@foreach($tv['created_by'] as $crew)
							<div class="mr-8">
								<div>{{ $crew['name'] }}</div>
								<div class="text-sm text-gray-400">Creator</div>
							</div>
						@endforeach
					</div>
				</div>
				
				<div x-data="{isOpen:false}">
					@if(count($tv['videos']['results']) > 0)
						<div class="mt-12">
							<button
									@click="isOpen=true"
									class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
							>
								<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current">
									<path
											d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
											fill="#111827"/>
								</svg>
								<span class="ml-2">Play Trailer</span>
							</button>
						</div>
						
						<div
								style="background-color: rgba(0,0,0,0.5);"
								class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
								x-show.transition.opacity="isOpen"
								x-cloak
						>
							<div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
								<div class="bg-gray-900 rounded">
									<div class="flex justify-end pr-4 pt-2">
										<button
												class="text-3xl leading-none hover:text-gray-300"
												@click="isOpen=false"
												@keydown.escape.window="isOpen=false"
										>&times;
										</button>
									</div>
									<div class="modal-body px-8 py-8">
										<div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
											<iframe
													src="https://www.youtube.com/embed/{{ $tv['videos']['results'][0]['key'] }}"
													width="560"
													height="315"
													class="responsive-iframe absolute top-0 left-0 w-full h-full border-none"
													allow="autoplay; encrypted-media"
													allowfullscreen
											></iframe>
										</div>
									</div>
								</div>
							</div>
						</div>
					
					@endif
				</div>
			</div>
		</div>
	</div>
	
	<div class="movie-cast border-b border-gray-800">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-4xl font-semibold">Cast</h2>
			
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
				@foreach($tv['cast'] as $cast)
					<div class="mt-8">
						<a href="{{ route('people.show', $cast['id']) }}">
							<img src="{{ $cast['profile_path'] }}" alt="{{ $cast['name'] }}"
							     class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
						<div class="flex flex-col mt-2">
							<a href="{{ route('people.show', $cast['id']) }}" class="text-lg text-white">{{ $cast['name'] }}</a>
							<div class="text-sm text-gray-500">{{ $cast['character'] }}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	
	<div class="movie-images" x-data="{isOpen:false, image: ''}">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-4xl font-semibold">Images</h2>
			
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
				@foreach($tv['images'] as $image)
					<div class="mt-8">
						<a
								href="#"
								@click.prevent="
										isOpen=true
										image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
									"
						>
							<img
									src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1"
									class="hover:opacity-75 transition ease-in-out duration-150">
						</a>
					</div>
				@endforeach
				
				<div
						style="background-color: rgba(0,0,0,0.5);"
						class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
						x-show.transition.opacity="isOpen"
						x-cloak
				>
					<div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
						<div class="bg-gray-900 rounded">
							<div class="flex justify-end pr-4 pt-2">
								<button
										class="text-3xl leading-none hover:text-gray-300"
										@click="isOpen=false"
										@keydown.escape.window="isOpen=false"
								>&times;
								</button>
							</div>
							<div class="modal-body px-8 py-8">
								<img :src="image" alt="poster">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection