
<x-guest-layout>
  <x-slot name="header">
      <x-header title="My wallets">
          <x-slot name="breadcrumb">
              <x-breadcrumb
                  :back-url="route('welcome')"
                  :items="[
                      [
                          'url' => route('welcome'),
                          'label' => 'Home',
                      ],
                  ]"
              />
          </x-slot>
      </x-header>
  </x-slot>

  <div class="w-full bg-white shadow dark:bg-gray-900">
      <div  class="relative">
  
          <table class="hidden w-full divide-y divide-gray-100 dark:divide-gray-800 md:table">
              <x-table-header :headers="$headers" :orderable="[]" :orderBy="null" />

              <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($wallets as $row)
                    <x-wallets-table-row :row="$row" :headers="$headers" />
                    @endforeach
              </tbody>
          </table>

          <div wire:key="responsive" class="flex flex-col">
              @if ($wallets)
                  @foreach ($wallets as $row)
                      <x-wallets-table-row :row="$row" :headers="$headers" :odd="$loop->odd" :responsive="true" />
                  @endforeach
              @endif
          </div>
          
          <div class="hidden px-6 py-4 lg:block">
              {{ $wallets->links('full-pagination') }}
          </div>
          <div class="px-6 py-4 lg:hidden">
              {{ $wallets->links('pagination') }}
          </div>
      </div>      
  </div>
</x-guest-layout>
