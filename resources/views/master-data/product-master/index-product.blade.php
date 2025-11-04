<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container p-4 mx-auto">
        <div class="overflow-x-auto">
            @if (session('success'))
            <div class="mb-4 rounded-lgbg-green-50 p-4 text-green-500">
                {{ session('success')}}
            </div>
            @elseif (session('error'))
            <div class="mb-4 rounded-lgbg-red-50 p-4 text-red-500">
                {{ session('error')}}
            </div>
            @endif

            <!-- form pencarian dan filter -->
            <form method="GET" action="{{ route('product-index') }}" class="mb-4 flex items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari produk..." class="w-1/4 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none 
            focus:ring-2 focus:ring-green-500">
                <button type="submit" class="ml-2 rounded-lg bg-green-500 px-4 py-2 text-white 
            shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Cari</button>
            </form>

            <a href="{{ route('product-create')}}">
                <button class="px-6 py-4 text-white bg-green-500 border 
                border-green-500 rounded-lg shadow-lg hover:bg-green-600
                focus:outline-none focus:ring-2 focus:ring-green-500 mb-10">
                    Add product data
                </button>
            </a>

            <a href="{{ route('product-export-excel')}}">
                <button class="px-6 py-4 text-white bg-green-500 border 
                border-green-500 rounded-lg shadow-lg hover:bg-green-600
                focus:outline-none focus:ring-2 focus:ring-green-500 mb-10">
                    Export to Excel
                </button>
            </a>

            <a href="{{ route('product-export-pdf')}}">
                <button class="px-6 py-4 text-white bg-green-500 border 
                border-green-500 rounded-lg shadow-lg hover:bg-green-600
                focus:outline-none focus:ring-2 focus:ring-green-500 mb-10">
                    Export to PDF
                </button>
            </a>

            <a href="{{ route('product-export-jpg')}}">
                <button class="px-6 py-4 text-white bg-green-500 border 
                border-green-500 rounded-lg shadow-lg hover:bg-green-600
                focus:outline-none focus:ring-2 focus:ring-green-500 mb-10">
                    Export to JPG
                </button>
            </a>

            @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
                {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
                {{ session('error') }}
            </div>
            @endif

            @php
            $sort = $sort ?? 'id';
            $direction = $direction ?? 'asc';
            @endphp

            <table class="min-w-full border border-collapse border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        {{-- Kolom ID (tidak pakai fitur sort) --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            ID
                        </th>

                        {{-- Product Name --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'product_name', 'direction' => $sort === 'product_name' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Product Name
                                @if ($sort === 'product_name')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Unit --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'unit', 'direction' => $sort === 'unit' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Unit
                                @if ($sort === 'unit')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Type --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'type', 'direction' => $sort === 'type' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Type
                                @if ($sort === 'type')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Information --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'information', 'direction' => $sort === 'information' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Information
                                @if ($sort === 'information')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Qty --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'qty', 'direction' => $sort === 'qty' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Qty
                                @if ($sort === 'qty')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Producer --}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">
                            <a href="{{ route('product-index', ['sort' => 'producer', 'direction' => $sort === 'producer' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Producer
                                @if ($sort === 'producer')
                                {{ $direction === 'asc' ? '↑' : '↓' }}
                                @else
                                ↑↓
                                @endif
                            </a>
                        </th>

                        {{-- Aksi--}}
                        <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr class="bg-white">
                        <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
                        <td class="px-4 py-2 border border-gray-200-hover:text-blue-500 hover:underline">
                            <a href="{{ route('product-detail', $item->id) }}">
                                {{$item->product_name }}
                            </a>
                        </td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->unit }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->type }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->information }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->qty }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $item->producer }}</td>
                        <td class="px-4 py-2 border border-gray-200">
                            <a href="{{ route('product-edit', $item->id) }}"
                                class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                            <button class="px-2 text-red-600 hover:text-red-800"
                                onclick="confirmDelete('{{ route('product-delete', $item->id) }}')">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <p class="mb-4 text-center tetext-2xl font-bold text-red-600">No Products found</p>
                    @endforelse

                </tbody>
            </table>
            <!-- pagination -->
            <div class="mt-4">
                {{ $data->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(deleteUrl) {
            if (confirm('Apakah Anda yakin ingin menghapus dataini?')) {
                // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                // Tambahkan CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();



            }
        }
    </script>

</x-app-layout>