<h1>New Order Notification</h1>
<p>You have sold the following items:</p>
<ul>
    @foreach ($cartItems as $item)
        <li>
            {{ $item['quantity'] }} x {{ $item['title'] }} (Price: {{ $item['price'] }}, Total: {{ $item['total'] }})
        </li>
    @endforeach
</ul>
<p>Order ID: {{ $order->id }}</p>
<p>Customer: {{ $order->full_name }}</p>
