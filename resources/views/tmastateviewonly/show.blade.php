<x-guest-layout> 
    <x-slot name="header">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('welcome') }}">
                <x-jet-application-mark class="block h-9 w-auto" />
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                TMA Lille 3.1
            </h2>
        </div>

    </x-slot> 
        <div class="py-12 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
          <div class="w-full sm:max-w-3xl mt-6 px-6 py-4 text-gray-900 dark:text-white bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <p class="text-2xl capitalize">{{ __('state') }}</p>
            <p class="text-2xl font-bold uppercase">{{ __($state_change->statemessage->message) }}<span class="text-sm"> {{ (($state_change->statemessage->id==2)?__('until').' '.$state_change->created_at->addSeconds($state_change->validity_s)->isoFormat('LLLL').' GMT':'')}}</span></p>
            @if (!is_null($state_change->created_at))
            <p class="text-2xl capitalize">{{ __('timestamp')}}</p>
            <p class="text-2xl font-bold">{{ $state_change->created_at }} GMT</p>
            @endif
            <div x-data="{ open: false }">
                <button @click="open = true" class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 capitalize">{{__('message')}}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul
                    x-show="open"
                    @click.away="open = false"
                >
                    <p class="text-xs">{{ $state_change->json }}</p> 
                </ul>
            </div>
            <div x-data="{ open: false }">
                <button @click="open = true" class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 capitalize">{{__('authority')}}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul
                    x-show="open"
                    @click.away="open = false"
                >
                    <p class="text-xs break-all">{{ $state_change->user->name }}</p> 
                </ul>
            </div> 
            <div x-data="{ open: false }">
                <button @click="open = true" class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 whitespace-nowrap ">{{__('signing the message')}}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul
                    x-show="open"
                    @click.away="open = false"
                >
                    <p class="text-xs break-all">{{ $state_change->signature }}</p> 
                </ul>
            </div> 
            <div x-data="{ open: false }">
                <button @click="open = true" class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 capitalize">{{__("control")}}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul
                    x-show="open"
                    @click.away="open = false"
                >
                {!! QrCode::size(300)->generate($state_change->secured_message_verification); !!}
                </ul>
            </div>              
          </div>
        </div>
      </div>
    <x-slot name="footer">
        
    </x-slot>
</x-guest-layout>