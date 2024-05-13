<tr class="bg-white" onclick="window.location.href = '{{ route('crypto.show', $crypto['id']) }}'">
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <div class="text-sm leading-5 text-gray-900">{{ $crypto['market_cap_rank'] }}</div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="{{ $crypto['image'] }}" alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm leading-5 font-medium text-gray-900">
                    {{ $crypto['name'] }} ({{ $crypto['symbol'] }})
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        ${{ number_format($crypto['current_price'], 2) }}
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        @if ($crypto['price_change_percentage_1h_in_currency'] > 0)
            <span class="text-green-600 text-xs">{{ number_format($crypto['price_change_percentage_1h_in_currency'], 2) }}%</span>
        @else
            <span class="text-red-600 text-xs">{{ number_format($crypto['price_change_percentage_1h_in_currency'], 2) }}%</span>
        @endif

    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        @if ($crypto['price_change_percentage_24h_in_currency'] > 0)
            <span class="text-green-600 text-xs">{{ number_format($crypto['price_change_percentage_24h_in_currency'], 2) }}%</span>
        @else
            <span class="text-red-600 text-xs">{{ number_format($crypto['price_change_percentage_24h_in_currency'], 2) }}%</span>
        @endif

    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        @if ($crypto['price_change_percentage_7d_in_currency'] > 0)
            <span class="text-green-600 text-xs">{{ number_format($crypto['price_change_percentage_7d_in_currency'], 2) }}%</span>
        @else
            <span class="text-red-600 text-xs">{{ number_format($crypto['price_change_percentage_7d_in_currency'], 2) }}%</span>
        @endif

    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        ${{ number_format($crypto['market_cap'], 0) }}
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        ${{ number_format($crypto['circulating_supply'], 0)  }}
        @if($crypto['max_supply'] != 0)
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full"
                     style="width: {{ $crypto['circulating_supply'] / $crypto['max_supply'] * 100 }}%"></div>
            </div>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
        <canvas id="crypto_{{ $crypto['id'] }}" width="400" height="200"></canvas>
    </td>
</tr>


<script>
    var ctx = document.getElementById( 'crypto_{{ $crypto['id'] }}' ).getContext( '2d' );
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach ($crypto['sparkline_in_7d']['price'] as $price)
                    '$' + parseFloat( '{{ $price }}' ).toFixed( 2 ),
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($crypto['sparkline_in_7d']['price'] as $price)
                    parseFloat( '{{ $price }}' ).toFixed( 2 ),
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    } );
</script>
