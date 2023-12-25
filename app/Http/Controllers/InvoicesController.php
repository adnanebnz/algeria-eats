<?php

namespace App\Http\Controllers;

use App\Models\Order;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;

class InvoicesController extends Controller
{
    public function create(Order $order)
    {
        $customer = new Buyer([
            'name' => $order->buyer->getFullName(),
            'custom_fields' => [
                'Adresse' => $order->adresse,
                'Wilaya' => $order->wilaya,
                'Daira' => $order->daira,
                'Commune' => $order->commune,
                'Numéro de Telephone' => $order->buyer->num_telephone,
                'Email' => $order->buyer->email,
            ],
        ]);

        $artisan = new Party([
            'name' => $order->artisan->getFullName(),
            'custom_fields' => [
                'Adresse' => $order->artisan->adresse,
                'Wilaya' => $order->artisan->wilaya,
                'Numéro de Telephone' => $order->artisan->num_telephone,
                'Email' => $order->artisan->email,
            ],
        ]);

        $items = $order->orderItems->map(function ($orderItem) {
            return InvoiceItem::make($orderItem->product->nom)
                ->pricePerUnit($orderItem->product->prix)
                ->quantity($orderItem->quantity);
        });

        $invoice = Invoice::make()
            ->seller($artisan)
            ->buyer($customer)
            ->addItems($items)
            ->dateFormat('d/m/Y')
            ->currencySymbol('DA')
            ->currencyCode('DZD')
            ->currencyFormat('{VALUE} {SYMBOL}')
            ->filename(
                'invoice_'.$order->id.'_'.$order->buyer->getFullName()
            )
            ->save('public');

        return $invoice->stream();
    }
}
