@extends('layouts.main')

@section('content')
	<div class="container mx-auto px-4 py-16">
		<div class="popular-people">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">
				Popular People
			</h2>
			
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
				@foreach($popularPeople as $person)
					<div class="person mt-8">
						<a href="{{ route('people.show', $person['id']) }}">
							<img
									class="hover:opacity-75 transition ease-in-out duration-150 w-full"
									src="{{ $person['profile_path'] }}"
									alt="people image"
							>
						</a>
						
						<div class="mt-2">
							<a href="#" class="text-lg hover:text-gray-300">{{ $person['name'] }}</a>
							<div class="text-sm truncate text-gray-400">{{ $person['known_for'] }}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		
		<div class="page-load-status mt-8">
			<div class="flex justify-center">
				<div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
			</div>
			<p class="infinite-scroll-last">End of content</p>
			<p class="infinite-scroll-error">Error</p>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
	
	<script>
		let elem = document.querySelector('.grid');
		let infScroll = new InfiniteScroll(elem, {
			path: '/people/page/@{{#}}',
			append: '.person',
			history: false,
			status: '.page-load-status'
		});
	</script>
@endsection
