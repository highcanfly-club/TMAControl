
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
          {{ __('current state')}} : {{ __($state_id->statemessage->message) }}
        </h2>
    </x-slot>    
    <div class="py-12">
      <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
          <x-jet-validation-errors class="mb-4" />
          @if (session()->has('message'))
            <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3">
              {{ session('message') }}
            </div>
          @endif
          <form method="POST" action="/tmastatechange">
              @csrf
              <div class="mt-4">
                {!! Form::label('id', __('New state'), ['class' => 'class="block font-medium text-sm text-gray-700"']); !!}
                {!! Form::select('id', App\Models\StateMessage::get()->pluck('message','id')->map(function($item,$key){return __($item);}),$state_id->statemessage->id,['class'=>'block mt-1 w-full']); !!}
              </div>
              <div class="flex items-center justify-end mt-4">
                  <x-jet-button class="ml-4">
                      {{ __('change state') }}
                  </x-jet-button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
</x-app-layout>