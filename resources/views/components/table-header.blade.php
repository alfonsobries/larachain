<thead>
    <tr>
        @foreach ($headers as $key => $header)
            <th id="{{ $key }}" class="text-left">
                @if(in_array($key, $orderable))
                <a
                    wire:click.prevent="orderBy('{{$key}}')"
                    class="flex justify-between px-4 py-2 text-xs font-semibold uppercase hover:text-blue-600 {{ \Str::startsWith($orderBy, $key) ? 'text-gray-700' : 'text-gray-400' }} "
                    href="#"
                >
                    <span>{{ $header }}</span>

                    <span class="ml-3">
                        @if($orderBy === $key . ':asc')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                        @elseif($orderBy === $key . ':desc')
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                        @endif
                    </span>
                </a>
                @else
                <span
                    class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase"
                >
                    {{ $header }}
                </span>
                @endif
            </th>
        @endforeach
    </tr>
</thead>