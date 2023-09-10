@php
    $bestSellers = \App\Models\Product::bestSellers();
@endphp

<div class="slider-scroll">

    <div class="title">

        <p>
            پرفروش ترین ها
        </p>
        <a>
            <span>
                لیست کامل
            </span>
            <span class="plus">
                +
            </span>
        </a>

    </div>

    <div class="sliderscroll-prev">
        <span class="prev-icon" onclick="sliderScroll('right' , this);"></span>
        <span class="prev-icon-gray"></span>
    </div>

    <div class="sliderscroll-main">

        <ul>
            @foreach($bestSellers as $product)
                <li>
                    <a href="{{ route('product', $product->id) }}">
                        <img class="scroll-img" src="{{ $product->image }}"
                             height="130">

                        <p class="name">{{ $product->fix_title }}</p>

                        @if($product->discount == 0)
                            <p class="price">
                                {{ $product->first_price }}
                                <span class="toman">تومان</span>
                            </p>
                        @else
                            <del class="price-off">{{ $product->first_price }}</del>

                            <p class="price">
                                {{ $product->discounted_price }}
                                <span class="toman">تومان</span>
                            </p>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <div class="sliderscroll-next">
        <span class="next-icon" onclick="sliderScroll('left' , this);"></span>
        <span class="next-icon-gray"></span>
    </div>

</div>
