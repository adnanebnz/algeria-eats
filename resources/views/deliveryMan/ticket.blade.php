<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>

<body>
    <style>
        body {
            margin: 0 !important;
        }

        .TicketLogo {
            width: 110px;
            height: 100px;
        }

        #barcode img {
            height: 75px;
            width: 75px;
            max-width: 75px;
            max-height: 75px;
        }
    </style>
    <div class="TTicket" style="margin: 0px; height: 192px; width: 530px;">
        <table width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
            <tr>

                <td width="110" valign="top" style="margin-left: 5px">
                    <div style="padding: 10px 0 0 0;"><img src="asset('assets/LOGO.png') }}" height="100" /></div>
                    <div style="padding: 5px 0 0 5px;">OrderID #{{ $delivery->order->id }}</div>
                    <div style="padding: 2px 0 0 5px;"><b>{{ $delivery->order->buyer->getFullName() }}</b></div>
                </td>
                <td valign="top" style="padding-top:10px; padding-left: 15px">
                    <div style="padding: 15px 0 0 0; font-size: 16px;"><b>Bon de Livraison</b></div>
                    <div style="padding: 5px 0 0 0; font-size: 14px;"><b>Fait le
                            {{ $delivery->updated_at->format('d/m/Y') }}</b></div>
                    <div style="padding: 15px 0 0 0; font-size: 14px;"><b>{{ $delivery->order->wilaya }}</b></div>
                    <div style="padding: 0 0 0 0; font-size: 12px;">{{ $delivery->order->adresse }}
                        {{ $delivery->order->daira }} {{ $delivery->order->commune }}</div>
                </td>
                <td width="100" valign="top">
                    <div id="barcode" style="padding: 5px 0 5px 0; max-width:100%;text-align: right;">
                        @php
                            echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"  height="100"  />';
                        @endphp
                    </div>
                    <div style="text-align: right; width: 100%; padding: 0 7px 0 0; font-size: 16px;">
                        <b>2000 DA</b>
                    </div>
                    <div
                        style="text-align: right; width: 100%; padding: 0 7px 0 0; font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        1</div>
                    <div style="text-align: right; width: 100%; padding: 2px 7px 0 0; font-size: 12px;">
                        {{ $delivery->order->id }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
