@extends('layouts.app')
@section('title', 'Checkout — Gob Sports')

@section('content')
<style>
.checkout-wrap { max-width: 800px; margin: 2rem auto; padding: 0 1.5rem; }

/* Steps Bar */
.steps-bar { display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; background: #fff; border-radius: 12px; padding: 1.25rem 2rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
.step { display: flex; flex-direction: column; align-items: center; gap: 4px; }
.step-circle { width: 36px; height: 36px; border-radius: 50%; background: #ddd; color: #888; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; transition: all .3s; }
.step-circle.active { background: #1a7a4a; color: #fff; }
.step-circle.done { background: #1a7a4a; color: #fff; }
.step-label { font-size: 12px; font-weight: 600; color: #888; transition: color .3s; }
.step-label.active { color: #1a7a4a; }
.step-line { height: 2px; width: 100px; background: #ddd; margin-bottom: 16px; transition: background .3s; }
.step-line.done { background: #1a7a4a; }

/* Cards */
.card { background: #fff; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
.card h3 { margin: 0 0 1.25rem; font-size: 17px; border-left: 3px solid #f0b429; padding-left: 10px; }

/* Steps visibility */
.step-content { display: none; }
.step-content.active { display: block; }

/* Form inputs */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-group { margin-top: 1rem; }
.form-group label { font-size: 13px; font-weight: 600; display: block; margin-bottom: 4px; }
.form-group input, .form-group select {
    width: 100%; padding: 10px 12px; border: 1px solid #ddd;
    border-radius: 8px; font-size: 14px; box-sizing: border-box;
    transition: border-color .2s;
}
.form-group input:focus, .form-group select:focus { outline: none; border-color: #1a7a4a; }

/* Payment options */
.pay-options { display: flex; gap: 1rem; margin-bottom: 1rem; }
.pay-label { flex: 1; border: 2px solid #ddd; border-radius: 8px; padding: 12px; text-align: center; cursor: pointer; transition: border-color .2s; font-size: 14px; font-weight: 600; }
.pay-label.selected { border-color: #111; }

/* Review items */
.review-item { display: flex; justify-content: space-between; align-items: center; padding: .65rem 0; border-bottom: 1px solid #f0f0f0; }
.review-item:last-child { border-bottom: none; }
.review-item-left { display: flex; align-items: center; gap: .75rem; }
.review-item-name { font-weight: 600; font-size: 15px; }
.review-item-qty { color: #888; font-size: 13px; }
.review-item-price { font-weight: 700; }
.summary-row { display: flex; justify-content: space-between; padding: .4rem 0; color: #555; font-size: 14px; }
.summary-total { display: flex; justify-content: space-between; font-weight: 800; font-size: 18px; margin-top: .5rem; padding-top: .75rem; border-top: 2px solid #f0f0f0; }
.shipping-to { color: #555; font-size: 14px; margin-top: .5rem; }
.shipping-to strong { color: #111; }

/* Buttons */
.btn-row { display: flex; gap: 1rem; margin-top: 1.5rem; }
.btn-back { flex: 1; background: #fff; color: #111; border: 2px solid #111; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; }
.btn-next { flex: 2; background: #111; color: #fff; border: none; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; }
.btn-next:hover { background: #333; }
.btn-place { width: 100%; background: #111; color: #fff; border: none; padding: 16px; border-radius: 10px; font-size: 16px; font-weight: 700; cursor: pointer; margin-top: 1.5rem; }
.btn-place:hover { background: #333; }
</style>

<div class="checkout-wrap">

    {{-- Steps Bar --}}
    <div class="steps-bar">
        <div class="step">
            <div class="step-circle active" id="circle-1">1</div>
            <span class="step-label active" id="label-1">Shipping</span>
        </div>
        <div class="step-line" id="line-1"></div>
        <div class="step">
            <div class="step-circle" id="circle-2">2</div>
            <span class="step-label" id="label-2">Payment</span>
        </div>
        <div class="step-line" id="line-2"></div>
        <div class="step">
            <div class="step-circle" id="circle-3">3</div>
            <span class="step-label" id="label-3">Review</span>
        </div>
    </div>

    @if($errors->any())
        <div style="background:#f8d7da; color:#721c24; padding:12px 16px; border-radius:8px; margin-bottom:1rem;">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm">
        @csrf

        {{-- ── STEP 1: Shipping ── --}}
        <div class="step-content active" id="step-1">
            <div class="card">
                <h3>Shipping Information</h3>
                <div class="form-grid">
                    <div class="form-group" style="margin-top:0">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Ahmad" required>
                    </div>
                    <div class="form-group" style="margin-top:0">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Razif" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="No. 12, Jalan Setapak..." required>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" placeholder="Kuala Lumpur" required>
                    </div>
                    <div class="form-group">
                        <label>Postcode</label>
                        <input type="text" name="postcode" id="postcode" value="{{ old('postcode') }}" placeholder="53000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+60 12-345 6789" required>
                </div>
            </div>
            <div class="btn-row">
                <button type="button" class="btn-next" onclick="goToStep(2)">Continue to Payment →</button>
            </div>
        </div>

        {{-- ── STEP 2: Payment ── --}}
        <div class="step-content" id="step-2">
            <div class="card">
                <h3>Payment Method</h3>
                <div class="pay-options">
                    <label class="pay-label selected" id="label-card">
                        <input type="radio" name="payment_method" value="card" checked style="display:none;">
                        💳 Credit Card
                    </label>
                    <label class="pay-label" id="label-bank">
                        <input type="radio" name="payment_method" value="bank" style="display:none;">
                        🏦 Online Banking
                    </label>
                    <label class="pay-label" id="label-ewallet">
                        <input type="radio" name="payment_method" value="ewallet" style="display:none;">
                        📱 e-Wallet
                    </label>
                </div>

                <div id="card-fields">
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="text" name="expiry" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" name="cvv" placeholder="123">
                        </div>
                    </div>
                </div>

                <div id="bank-fields" style="display:none;">
                    <div class="form-group">
                        <label>Select Bank</label>
                        <select name="bank_name">
                            <option>Maybank</option><option>CIMB Bank</option>
                            <option>Public Bank</option><option>RHB Bank</option>
                            <option>Hong Leong Bank</option>
                        </select>
                    </div>
                </div>

                <div id="ewallet-fields" style="display:none;">
                    <div class="form-group">
                        <label>Select e-Wallet</label>
                        <select name="ewallet_name">
                            <option>Touch 'n Go</option><option>GrabPay</option>
                            <option>Boost</option><option>ShopeePay</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="btn-row">
                <button type="button" class="btn-back" onclick="goToStep(1)">← Back</button>
                <button type="button" class="btn-next" onclick="goToStep(3)">Review Order →</button>
            </div>
        </div>

        {{-- ── STEP 3: Review ── --}}
        <div class="step-content" id="step-3">
            <div class="card">
                <h3>Review Your Order</h3>
                @foreach($cartItems as $item)
                <div class="review-item">
                    <div class="review-item-left">
                        <span style="font-size:26px;">{{ $item->product->emoji ?? '🏅' }}</span>
                        <div>
                            <div class="review-item-name">{{ $item->product->name }}</div>
                            <div class="review-item-qty">x{{ $item->quantity }}</div>
                        </div>
                    </div>
                    <div class="review-item-price">RM{{ number_format($item->product->price * $item->quantity, 2) }}</div>
                </div>
                @endforeach
                <div style="margin-top:1rem; padding-top:.75rem; border-top:1px solid #f0f0f0;">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>RM{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>{{ $shipping == 0 ? 'FREE' : 'RM'.number_format($shipping,2) }}</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>RM{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Shipping To</h3>
                <div class="shipping-to" id="review-address">—</div>
            </div>

            <div class="card">
                <h3>Payment</h3>
                <div class="shipping-to" id="review-payment">—</div>
            </div>

            <div class="btn-row">
                <button type="button" class="btn-back" onclick="goToStep(2)">← Back</button>
            </div>
            <button type="submit" class="btn-place">Place Order 🎉</button>
        </div>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Step navigation ──
    window.goToStep = function(n) {
        if (n === 2 && !validateStep1()) return;

        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.getElementById('step-' + n).classList.add('active');

        // Update circles & labels
        [1,2,3].forEach(i => {
            const circle = document.getElementById('circle-' + i);
            const label  = document.getElementById('label-' + i);
            circle.classList.remove('active','done');
            label.classList.remove('active');
            if (i < n)  { circle.classList.add('done'); }
            if (i === n){ circle.classList.add('active'); label.classList.add('active'); }
        });

        // Update lines
        document.getElementById('line-1').classList.toggle('done', n > 1);
        document.getElementById('line-2').classList.toggle('done', n > 2);

        if (n === 3) populateReview();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // ── Step 1 validation ──
    function validateStep1() {
        const fields = ['first_name','last_name','address','city','postcode','phone'];
        for (const id of fields) {
            const el = document.getElementById(id);
            if (!el.value.trim()) {
                el.focus();
                el.style.borderColor = '#e53e3e';
                setTimeout(() => el.style.borderColor = '#ddd', 2000);
                return false;
            }
        }
        return true;
    }

    // ── Payment method toggle ──
    const payLabels = {
        card:    document.getElementById('label-card'),
        bank:    document.getElementById('label-bank'),
        ewallet: document.getElementById('label-ewallet'),
    };
    const payFields = {
        card:    document.getElementById('card-fields'),
        bank:    document.getElementById('bank-fields'),
        ewallet: document.getElementById('ewallet-fields'),
    };

    Object.keys(payLabels).forEach(method => {
        payLabels[method].addEventListener('click', function () {
            Object.keys(payLabels).forEach(m => {
                payLabels[m].classList.toggle('selected', m === method);
                payFields[m].style.display = m === method ? 'block' : 'none';
            });
            this.querySelector('input').checked = true;
        });
    });

    // ── Populate review step ──
    function populateReview() {
        const fn  = document.getElementById('first_name').value;
        const ln  = document.getElementById('last_name').value;
        const addr = document.getElementById('address').value;
        const city = document.getElementById('city').value;
        const pc   = document.getElementById('postcode').value;
        const ph   = document.getElementById('phone').value;
        document.getElementById('review-address').innerHTML =
            `<strong>${fn} ${ln}</strong>, ${addr}, ${city} ${pc} · ${ph}`;

        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const methodMap = { card: '💳 Credit Card', bank: '🏦 Online Banking', ewallet: '📱 e-Wallet' };
        document.getElementById('review-payment').textContent = methodMap[method];
    }
});
</script>
@endsection