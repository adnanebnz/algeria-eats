<?php

namespace App\Jobs;

use App\Mail\PurchaseMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;

class GenerateInvoiceAndSendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Generate customer and artisan details
        $customer = new Buyer([
            'name' => $this->order->buyer->getFullName(),
            'custom_fields' => [
                'Adresse' => $this->order->adresse,
                'Wilaya' => $this->order->wilaya,
                'Daira' => $this->order->daira,
                'Commune' => $this->order->commune,
                'Numéro de Telephone' => $this->order->buyer->num_telephone,
                'Email' => $this->order->buyer->email,
            ],
        ]);

        $artisan = new Party([
            'name' => $this->order->artisan->getFullName(),
            'custom_fields' => [
                'Adresse' => $this->order->artisan->adresse,
                'Wilaya' => $this->order->artisan->wilaya,
                'Numéro de Telephone' => $this->order->artisan->num_telephone,
                'Email' => $this->order->artisan->email,
            ],
        ]);

        // Generate invoice items
        $items = $this->order->orderItems->map(function ($orderItem) {
            return InvoiceItem::make($orderItem->product->nom)
                ->pricePerUnit($orderItem->prix_total / $orderItem->quantity)
                ->quantity($orderItem->quantity);
        });

        // Generate invoice
        $invoice = Invoice::make()
            ->seller($artisan)
            ->buyer($customer)
            ->addItems($items)
            ->serialNumberFormat('FACTURE-{SEQUENCE}')
            ->sequence(1)
            ->dateFormat('d/m/Y')
            ->payUntilDays(7)
            ->currencySymbol('DA')
            ->currencyCode('DZD')
            ->currencyFormat('{VALUE} {SYMBOL}')
            ->filename(
                'invoice_'.
                    $this->order->id.
                    '_'.
                    $this->order->buyer->getFullName()
            )
            ->save('public');

        // Send the purchase mail
        Mail::to($this->order->buyer->email)->send(
            new PurchaseMail($invoice, $this->order)
        );
    }
}
