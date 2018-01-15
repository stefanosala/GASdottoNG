<html>
    <body>
        <h3>{{ _i('Dettaglio Consegne') }}<br/>
            @foreach($aggregate->orders as $order)
                {{ $order->supplier->name }} {{ $order->internal_number }}<br/>
            @endforeach
        </h3>

        @foreach($bookings as $super_booking)
            @if($super_booking->total_value == 0)
                @continue
            @endif

            <table border="1" style="width: 100%" cellpadding="5" nobr="true">
                <tr>
                    <th colspan="3"><strong>{{ $super_booking->user->printableName() }}

                        <?php

                        $contacts = [];

                        foreach($super_booking->user->contacts as $contact) {
                            if ($contact->type == 'phone' || $contact->type == 'mobile')
                                $contacts[] = $contact->value;
                        }

                        if (!empty($contacts))
                            echo ' - ' . join(', ', $contacts);

                    ?></strong></th>
                </tr>

                @foreach($super_booking->bookings as $booking)
                    @if($booking->products_with_friends->isEmpty() == false)
                        <tr>
                            <td colspan="3"><strong>{{ $booking->order->supplier->printableName() }}</strong></td>
                        </tr>

                        @include('documents.booking_shipping', ['booking' => $booking])
                    @endif
                @endforeach

                <tr>
                    <th colspan="3"><strong>{{ _i('Totale') }}: {{ printablePrice($super_booking->total_value, ',') }} €</strong></th>
                </tr>
            </table>

            <p>&nbsp;</p>
        @endforeach
    </body>
</html>
