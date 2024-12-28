{{-- <x-app-layout>
  <div class="tw-mx-5 tw-p-4 tw-bg-gray-900 tw-rounded-lg">
    <h1 class="tw-text-3xl tw-text-white tw-font-bold">Fuel Consumptions</h1>
    <div class="tw-mt-4">
      <a href="{{ route('fuel.pages.create') }}" class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded">
        Add New Fuel Record
      </a>
    </div>

    <table class="tw-w-full tw-mt-4 tw-text-white">
      <thead>
        <tr class="tw-bg-gray-700">
          <th>No</th>
          <th>Vehicle</th>
          <th>Fuel Type</th>
          <th>Liters</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fuelConsumptions as $fuel)
        <tr class="tw-border-b tw-border-gray-600">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $fuel->vehicle->vehicle_name }}</td>
          <td>{{ $fuel->fuel_type }}</td>
          <td>{{ $fuel->fuel_liters }}</td>
          <td>{{ $fuel->fuel_date }}</td>
          <td>
            <a href="{{ route('fuel.pages.edit', $fuel) }}" class="tw-bg-orange-500 tw-px-3 tw-py-1 tw-rounded">Edit</a>
            <form action="{{ route('fuel.request.destroy', $fuel) }}" method="POST" class="tw-inline">
              @csrf @method('DELETE')
              <button type="submit" class="tw-bg-red-600 tw-px-3 tw-py-1 tw-rounded">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-app-layout> --}}

<x-app-layout>
    <div class="tw-rounded-lg tw-mx-5 tw-p-4 tw-bg-gray-900 tw-min-h-screen">
        <!-- Header Section -->
        <div class="tw-w-full tw-mb-5">
            <div class="tw-flex tw-justify-between tw-items-center tw-my-2">
                <h1 class="tw-text-2xl lg:tw-text-3xl tw-font-semibold tw-text-white">List Konsumsi BBM Kendaraan</h1>
                @if (auth()->user()->load('role')->role->role_name === 'Admin')
                    <a href="{{ route('fuel.pages.create') }}"
                        class="tw-px-4 tw-py-2 tw-rounded-lg tw-bg-orange-500 tw-text-white hover:tw-bg-orange-600">Tambah</a>
                @endif
            </div>
            <x-alert />
            <div class="tw-w-full tw-h-[1px] tw-bg-gray-700"></div>
        </div>


        <!-- Table Section -->
        <div class="tw-rounded-lg tw-shadow-lg tw-overflow-hidden tw-bg-gray-800">
            <table class="tw-w-full">
                <thead>
                    <tr class="tw-bg-blue-600">
                        <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center">No</th>
                        <th class="tw-py-3 tw-px-4 tw-text-white">Nama Kendaraan</th>
                        <th class="tw-py-3 tw-px-4 tw-text-white">Tipe BBM</th>
                        <th class="tw-py-3 tw-px-4 tw-text-white">Jumlah Liter</th>
                        <th class="tw-py-3 tw-px-4 tw-text-white">Tanggal</th>
                        <th class="tw-py-3 tw-px-4 tw-text-white tw-text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fuelConsumptions as $fuelConsumption)
                        <tr class="tw-border-b tw-border-gray-700 hover:tw-bg-gray-700">
                            <td class="tw-py-3 tw-px-4 tw-text-center tw-text-gray-300">{{ $loop->iteration }}</td>
                            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $fuelConsumption->vehicle->vehicle_name }}
                            </td>
                            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $fuelConsumption->fuel_type }}</td>
                            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $fuelConsumption->fuel_liters }}</td>
                            <td class="tw-py-3 tw-px-4 tw-text-gray-300">{{ $fuelConsumption->fuel_date }}</td>
                            <td class="tw-py-3 tw-px-4 tw-flex tw-justify-center tw-gap-2">
                                <a href="{{ route('fuel.pages.edit', $fuelConsumption->fuel_id) }}"
                                    class="tw-bg-orange-500 tw-text-white tw-px-3 tw-py-1 tw-rounded hover:tw-bg-orange-600">Edit</a>
                                <form action="{{ route('fuel.request.destroy', $fuelConsumption->fuel_id) }}" method="POST"
                                    class="tw-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="tw-bg-red-600 tw-text-white tw-px-3 tw-py-1 tw-rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="tw-mt-4 tw-flex tw-justify-center tw-gap-x-10">
            {!! $fuelConsumptions->links() !!}
        </div>
    </div>
</x-app-layout>
