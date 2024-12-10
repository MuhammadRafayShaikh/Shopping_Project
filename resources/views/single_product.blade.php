@extends('master', ['subcategory' => $subcategory, 'cartcount' => $cartcount])

@section('content')
    <style>
        .cartdiv {
            margin-top: 50px !important;
        }

        .reviewcontainer {
            margin-top: 50px !important;
        }

        .review {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating .fa-star {
            color: #FFD700;
        }

        .checked {
            color: #FFD700;
        }

        .review-body {
            margin-top: 10px;
            font-style: italic;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .average-rating {
            margin-top: 50px;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .average-rating .fa-star {
            font-size: 24px;
            color: #FFD700;
        }

        textarea.form-control {
            resize: none;
        }

        .submit-review {
            margin-top: 20px;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ff5c5c;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            transition: color 0.3s ease;
        }

        .delete-btn:hover {
            color: #ff1a1a;
        }

        .delete-review-form {
            display: inline;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .rating {
            display: flex;
            align-items: center;
        }

        .rating .fa-star {
            color: #FFD700;
            /* Gold color for stars */
            margin-right: 2px;
            /* Space between stars */
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ff5c5c;
            font-size: 16px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .delete-btn:hover {
            color: #ff1a1a;
        }
    </style>

    <div class="single-product-container">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-5 col-md-7">
                    <ol class="breadcrumb">
                        <li><a href="">Home</a></li>
                        <li><a href="">{{ $product->subcategory->sub_cat_name }}</a></li>
                        <li class="active">{{ $product->product_name }}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="product-image">
                        <img id="product-img" src="{{ asset('uploads/' . $product->product_image) }}" alt="" />
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="product-content">
                        <h3 class="title">Name : {{ $product->product_name }}</h3>
                        <hr>
                        <span class="title"><span style="font-weight: 600">Description:</span></span>

                        <span class="short-description description">{{ Str::limit($product->product_desc, 40) }}</span>
                        <span class="full-description description"
                            style="display: none;">{{ $product->product_desc }}</span>

                        <a href="javascript:void(0);" class="read-more">Read More</a>
                        <hr>
                        <span class="price"><span style="font-weight: 600">Price</span>:
                            {{ $product->product_price }}</span>
                        <hr>
                        @if ($product->product_qty == 0)
                            <span class="price text-danger"><span style="font-weight: 600">Stock</span>:
                                {{ $product->product_qty }} (Out of Stock)</span>
                        @else
                            <span class="price"><span style="font-weight: 600">Stock</span>:
                                {{ $product->product_qty }}</span>
                        @endif
                        <hr>
                        <div class="formdiv">
                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_price" value="{{ $product->product_price }}">

                                @if ($product->product_qty == 0)
                                    <input type="submit" value="Add to Cart" class="btn btn-primary" disabled>
                                @else
                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                @endif
                            </form>

                            <form action="{{ route('wishlist.store', $product->id) }}" method="POST">
                                @csrf
                                <input type="submit" value="Add to Wishlist" class="btn btn-secondary">
                            </form>
                        </div>

                    </div>
                </div>
                @if (session('cart'))
                    <div class="container cartdiv">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center empty-result">
                                    <p class="text-success">{{ session('cart') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('carterror'))
                    <div class="container cartdiv">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center empty-result">
                                    <p class="text-danger">{{ session('carterror') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if (session('review'))
                    <div class="container cartdiv">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center empty-result">
                                    <p class="text-success">{{ session('review') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Display average rating -->
                <div class="col-md-12 text-center">
                    <div class="average-rating">
                        <span>Average Rating: </span>
                        @php
                            $avgRating = $reviews->avg('rating');
                        @endphp
                        @for ($i = 1; $i <= $avgRating; $i++)
                            @if ($i <= $avgRating)
                                <span class="fa fa-star checked"></span>
                            @else
                                <span class="fa fa-star"></span>
                            @endif
                        @endfor
                        <span> ({{ round($avgRating, 1) }} / 5)</span>
                    </div>
                </div>

                <div class="container reviewcontainer">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <h4 class="text-center">Customer Reviews</h4>
                            <hr>
                            <div class="reviews">
                                @if ($reviews->count() > 0)
                                    @foreach ($reviews as $review)
                                        <div class="review">
                                            <div class="review-header">
                                                <strong>{{ $review->user->name }}</strong>
                                                <div class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <span class="fa fa-star checked"></span>
                                                        @else
                                                            <span class="fa fa-star"></span>
                                                        @endif
                                                    @endfor
                                                    @if ($review->user_id == Auth::id() && $deleteReview > 0)
                                                        <form
                                                            action="{{ route('review.destroy', [$review->id, $review->product_id]) }}"
                                                            method="POST" class="delete-review-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Delete Review?')"
                                                                class="delete-btn" title="Delete Review">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="review-body">
                                                <p>{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @auth
                                        <p class="text-center">No reviews yet. Be the first to review!</p>
                                    @endauth
                                @endif
                            </div>
                            <hr>
                            @if ($order > 0)
                                <h5>Submit Your Review</h5>
                                <form action="{{ route('review.store', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <select class="form-control" name="rating" id="rating" required>
                                            <option value="5">5 - Excellent</option>
                                            <option value="4">4 - Very Good</option>
                                            <option value="3">3 - Good</option>
                                            <option value="2">2 - Fair</option>
                                            <option value="1">1 - Poor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Your Review:</label>
                                        <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary submit-review">Submit Review</button>
                                </form>
                            @else
                                @auth
                                    <p class="text-center">You have to purchase to leave the comment!</p>
                                @else
                                    <p class="text-center">You need to login to leave the comment <a
                                            href="{{ route('login') }}">Click
                                            Here to Login</a></p>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const readMoreLink = document.querySelector('.read-more');
            const shortDescription = document.querySelector('.short-description');
            const fullDescription = document.querySelector('.full-description');

            readMoreLink.addEventListener('click', function() {
                if (fullDescription.style.display === 'none') {
                    fullDescription.style.display = 'inline';
                    shortDescription.style.display = 'none';
                    this.textContent = 'Show less';
                } else {
                    fullDescription.style.display = 'none';
                    shortDescription.style.display = 'inline';
                    this.textContent = 'Read more';
                }
            });
        });
    </script>

@endsection
