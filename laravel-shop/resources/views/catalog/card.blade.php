<div class="col-3 mb-4 d-flex align-items-stretch">
    <!-- Card -->
    <div class="card">
        <!-- Card image -->
        <img class="card-img-top" src="{{ $product->cover }}" alt="{{ $product->title }}">

        <!-- Card content -->
        <div class="card-body">
            <!-- Title -->
            <h5 class="card-title">
                <a href="{{ route('catalog.show', ['slug'=>$product->slug]) }}">
                    {{ $product->title }}
                </a>
            </h5>
            <p>
                @foreach($product->categories as $category)
                    <a href="#">
                        <span class="badge
                        @if($category->id == 1)
                            purple
                        @elseif($category->id == 2)
                            blue
                        @elseif($category->id == 3)
                            red
                        @elseif($category->id == 4)
                            yellow
                        @elseif($category->id == 5)
                            lime
                        @endif
                            mr-1">{{ $category->name }}</span>
                    </a>
                @endforeach
            </p>

            <p>${{ $product->price }}</p>
            <p class="card-text">
                {{ Str::limit($product->description, 120, '...') }}
            </p>
        </div>

        <div class="card-footer">
            <span class="badge {{ $product->stock > 0 ? 'badge-success' : 'badge-danger'}}">
                {{ $product->stock > 0 ? 'on stock' : 'not on stock' }}
            </span>

{{--            <span class="float-right">--}}
{{--                <a href="{{ $product->stock > 0 ? route('card.add', ['product_id'=>$product->id]) : '#'}}" class="btn btn-sm btn-outline-secondary waves-effect">--}}
{{--                    to cart <i class="fas fa-cart-arrow-down"></i>--}}
{{--                </a>--}}
{{--            </span>--}}
        </div>
    </div>
    <!-- Card -->
</div>
