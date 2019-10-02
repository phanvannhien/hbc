<ul>
    @foreach( $products as $product )
    <li>
        <a href="{{ route('product.detail',[ 'slug'=> $product->product_slug, 'id' => $product->id ]) }}">
            {{$product->product_name}}
        </a>
    </li>
    @endforeach
</ul>