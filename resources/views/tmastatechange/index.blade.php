
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
            {{ __('current state')}} : {{ __($state_id->statemessage->message) }}
        </h2>
    </x-slot>    
    <div class="py-12">
      <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
          <table class="table-auto shadow rounded-lg w-full">
            <thead>
              <tr>
                <th class="capitalize">{{ __('date') }} GMT</th>
                <th class="capitalize">{{ __('user') }}</th>
                <th class="capitalize">{{ __('state') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($last_states as $state)
              <tr>
                <td>{{ $state->created_at }}</td>
                <td>{{ $state->user->name }}</td>
                <td>{{ __($state->statemessage->message) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $last_states->links() }}
        </div>
      </div>
    </div>
  </div>  
</x-app-layout>