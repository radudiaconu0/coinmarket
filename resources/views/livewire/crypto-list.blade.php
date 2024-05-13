<div class="relative overflow-x-auto">
    <input type="text" wire:model.live="search" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-800 dark:text-gray-100"
           placeholder="Search for a cryptocurrency...">
    <div class="absolute z-10 w-full bg-white rounded-lg shadow-lg dark:bg-gray-800" wire:loading.class="hidden">
        @if (!empty($search))
            @if (!empty($searchResults))
                <div class="max-h-60 overflow-y-auto">
                    @foreach ($searchResults as $result)
                        <a href="{{ route('crypto.show', ['id' => $result['id']]) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <img src="{{ $result['thumb'] }}" alt="{{ $result['name'] }}" class="w-8 h-8 rounded-full mr-2">
                            <span>{{ $result['name'] }} ({{ $result['symbol'] }})</span>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="px-4 py-2">No results found for "{{ $search }}"</p>
            @endif
        @endif
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                #
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name (Symbol)
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Current Price
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                1h %
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                24h %
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                7d %
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Market Cap
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Circulating Supply
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Last 7 days
            </th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @php
            $i = 1;
        @endphp

        @foreach ($cryptos as $crypto)


                <livewire:crypto-element :crypto="$crypto" :key="$crypto['id']"/>

        @endforeach
        </tbody>
    </table>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets
