<h1>Here are your order details:</h1>
<ul>
    @foreach ($cartItems as $item)
        <li>
            {{ $item['quantity'] }} x {{ $item['title'] }} (Price: {{ $item['price'] }})
        </li>
    @endforeach
</ul>
<p>Total Amount: {{ $order->total_amount }}</p>
