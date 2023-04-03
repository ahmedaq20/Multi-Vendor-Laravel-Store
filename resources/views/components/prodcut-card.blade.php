<div class="single-product">
    <div class="product-image">
        <img src="{{$product->image_url}}" alt="#">
        @if ($product->compare_price)
       {{-- Discount = 100 × (Original price - Discounted price) / Original price --}}
       @php
           $Discounted = 100*($product->compare_price - $product->price)/ $product->compare_price
       @endphp
        <span class="sale-tag">{{rand($Discounted, 0)}}%</span>
        @endif

        <div class="button">
            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{$product->category->name}}</span>
        <h4 class="title">
            <a href="{{route('product.show',$product->slug)}}">{{$product->name}}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><span>5.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{Currency::format($product->price,'USD')}}</span>
            @if ($product->compare_price)
            <span class="discount-price">{{Currency::format($product->compare_price,'USD')}}</span>
            @endif

        </div>
    </div>
</div>
