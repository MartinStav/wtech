<h2 class="h6 fw-bold text-uppercase mb-3">Order summary</h2>
@foreach ($cartRows as $row)
    @php
        /** @var \App\Models\Product $p */
        $p = $row->product;
    @endphp
    <div class="d-flex justify-content-between small mb-2">
        <span>{{ $p->name }} ×{{ $row->quantity }}</span>
        <span>{{ number_format($row->line_total, 2, ',', ' ') }} €</span>
    </div>
@endforeach
<hr>
<div class="d-flex justify-content-between mb-2 small">
    <span>Subtotal</span>
    <span>{{ number_format($subtotal, 2, ',', ' ') }} €</span>
</div>
<div class="d-flex justify-content-between mb-2 small">
    <span>Shipping</span>
    <span>{{ number_format($shippingFee, 2, ',', ' ') }} €</span>
</div>
<div class="d-flex justify-content-between mb-3 small">
    <span>Tax (20%)</span>
    <span>{{ number_format($tax, 2, ',', ' ') }} €</span>
</div>
<hr>
<div class="d-flex justify-content-between fw-bold">
    <span>Total</span>
    <span>{{ number_format($total, 2, ',', ' ') }} €</span>
</div>
