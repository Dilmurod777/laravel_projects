@extends('layouts.app')

@section('title') {{ $product->title }} @endsection

@section('content')
    <div class="container dark-grey-text mt-5">
        <div class="row wow fadeIn">
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ $product->cover }}" alt="" class="img-fluid img-thumbnail">
                    </div>
                </div>

                <div class="row mt-2">
                    @foreach($product->gallery->images as $photo)
                        <div class="col-3">
                            <img src="{{ $photo->path }}" alt="" class="img-fluid img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="p-4">
                    <div class="mb-3">
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
                    </div>

                    <p class="lead">
                        <span class="mr-1"></span>
                        <span>
                            <span>${{ $product->price }}</span>
                        </span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>

        <hr>

        <div class="row d-flex justify-content-center wow fadeIn">
            <div class="col-md-6 text-center">
                <h4 class="my-4 h4">Additional Information</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>
        </div>

        <div class="row wow fadeIn">
            <div class="col-lg-4 col-md-12 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" alt="" class="img-fluid">
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" alt="" class="img-fluid">
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
