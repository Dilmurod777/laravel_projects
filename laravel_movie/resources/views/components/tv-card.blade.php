<div class="mt-8">
    <a href="{{ route('tv.show', $tv['id']) }}">
        <img src="{{ $tv['poster_path'] }}" alt="parasite"
             class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="#" class="text-lg mt-2 hover:text-gray-300">{{ $tv['name'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
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
        </div>
        
        <div class="text-gray-400 text-sm">{{ $tv['genres'] }}</div>
    </div>
</div>