<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-5">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ $crypto['name'] }} ({{ $crypto['symbol'] }})
            </h2>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Current Price
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            ${{ number_format($crypto["market_data"]['current_price']['usd'], 2) }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">
                            Market Cap
                        </dt>
                        <dd class="mt-1 text-xl font-medium text-gray-900">
                            ${{ number_format($crypto["market_data"]['market_cap']["usd"], 0) }}
                        </dd>
                    </div>
                    <!-- Add more statistics here -->
                </div>
            </dl>
        </div>
        <div>
            <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        1h %
                    </dt>
                    <dd class="mt-1 text-xl font-medium text-gray-900">
                        @if ($crypto["market_data"]['price_change_percentage_1h_in_currency'] > 0.0)
                            <span class="text-green-600">{{ number_format($crypto["market_data"]['price_change_percentage_1h_in_currency']["usd"], 2) }}%</span>
                        @else
                            <span class="text-red-600">{{ number_format($crypto["market_data"]['price_change_percentage_1h_in_currency']["usd"], 2) }}%</span>
                        @endif
                    </dd>
                </div>
            </div>
            <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        24h %
                    </dt>
                    <dd class="mt-1 text-xl font-medium text-gray-900">
                        @if ($crypto["market_data"]['price_change_percentage_24h_in_currency'] > 0.0)
                            <span class="text-green-600">{{ number_format($crypto["market_data"]['price_change_percentage_24h_in_currency']["usd"], 2) }}%</span>
                        @else
                            <span class="text-red-600">{{ number_format($crypto["market_data"]['price_change_percentage_24h_in_currency']["usd"], 2) }}%</span>
                        @endif
                    </dd>
                </div>
            </div>
            <div class="bg-white px-4 py-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        7d %
                    </dt>
                    <dd class="mt-1 text-xl font-medium text-gray-900">
                        @if ($crypto["market_data"]['price_change_percentage_7d_in_currency'] > 0)
                            <span class="text-green-600">{{ number_format($crypto["market_data"]['price_change_percentage_7d_in_currency']["usd"], 2) }}%</span>
                        @else
                            <span class="text-red-600">{{ number_format($crypto["market_data"]['price_change_percentage_7d_in_currency']["usd"], 2) }}%</span>
                        @endif
                    </dd>
                </div>
        </div>

    </div>

    <div id="charts" class="my-8">
        <h3 class="text-lg font-medium text-gray-900">

        </h3>
        <div class="mt-3">
            <div class="bg-gray-100 h-64 rounded-lg text-center leading-64">
                <canvas id="chart" class="w-full"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-5">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium text-gray-900">
                About {{ $crypto['name'] }}
            </h3>
            <div class="mt-2 space-y-2 text-sm text-gray-700">
                <p>{{ $crypto['description']["en"] ?? 'No description available.' }}</p>
            </div>
        </div>
    </div>
</div>
@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets
<script>

    // Create a new chart instance
    const ctx = document.getElementById( 'chart' ).getContext( '2d' );
    const chart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach($crypto["market_data"]['sparkline_7d']['price'] as $price)
                    '$' + parseFloat('{{ $price }}').toFixed(2),
                @endforeach
            ],
            datasets: [{
                label: 'Price',
                data: [
                    @foreach($crypto["market_data"]['sparkline_7d']['price'] as $price)
                    parseFloat('{{ $price }}').toFixed(2),
                    @endforeach
                ],
                borderColor: '#3182ce',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    } );
</script>
