<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutService implements CheckoutServiceInterface
{
    public function checkout(array $attributes)
    {
        $cart_ids = $attributes['cart_ids'];
        $address_id = $attributes['address_id'];

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $total_amount = 0; // Initialize total amount

            // Loop through cart IDs to calculate the total amount
            foreach ($cart_ids as $cart_id) {
                $cart = Cart::find($cart_id);
                if ($cart) {
                    $product = Product::find($cart->product_id);
                    if ($product) {
                        $total_amount += $product->price * $cart->quantity;
                    }
                }
            }

            // Create a payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $total_amount * 100,
                'currency' => 'usd',
            ]);

            // Create order in orders table
            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $address_id,
                'status' => 'to ship',
                'total_amount' => $total_amount, // Save the total amount in the order table
            ]);

            // Process order products
            foreach ($cart_ids as $cart_id) {
                $cart = Cart::find($cart_id);
                if ($cart) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                    ]);

                    $cart->delete();
                }
            }

            return response()->json(['client_secret' => $paymentIntent->client_secret], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
}
