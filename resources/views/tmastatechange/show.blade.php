<?php
$_validity_s_enabled_class = 'text-gray-700';
$_validity_s_disabled_class = 'text-gray-300';
$_validity_s_initial_class = ($state_id->statemessage->id == 2) ? $_validity_s_enabled_class : $_validity_s_disabled_class; 
?>
<script>
  var _validity_select_handler = function(){
    let selected = $('#id').val();
    if ((selected == 1) || (selected == 3)){
      $('#validity_s').prop('disabled', 'disabled');
      $('#validity_s').removeClass("{{$_validity_s_enabled_class}}");
      $('#validity_s').addClass("{{$_validity_s_disabled_class}}");
    }else{
      $('#validity_s').removeAttr("disabled");
      $('#validity_s').removeClass("{{$_validity_s_disabled_class}}");
      $('#validity_s').addClass("{{$_validity_s_enabled_class}}");
    }
  }
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight uppercase">
          {{ __('current state')}} : {{ __($state_id->statemessage->message) }} <span class="text-sm">{{ (($state_id->statemessage->id==2)?__('until').' '.$state_id->created_at->addSeconds($state_id->validity_s)->isoFormat('LLLL').' GMT':'')}}</span>
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
                {!! Form::label('id', __('New state'), ['class' => 'block font-medium text-sm text-gray-700']); !!}
                {!! Form::select('id', App\Models\StateMessage::get()->pluck('message','id')->map(function($item,$key){return __($item);}),$state_id->statemessage->id,['class'=>'block mt-1 w-full','onchange'=>'_validity_select_handler();']); !!}
              </div>
              <div class="mt-4">
                {!! Form::label('validity_s', __('Validity (h)'), ['class' => 'block font-medium text-sm text-gray-700']); !!}
                {!! Form::select('validity_s',[App\Helpers\TMAUtilities::getSunsetDeltaTs()=>__('Sunset in')."&nbsp;".App\Helpers\TMAUtilities::getSunsetDeltaTsAsHM(), App\Helpers\TMAUtilities::getAeronauticalNightDeltaTs()=>__('Aeronautical night in')."&nbsp;".App\Helpers\TMAUtilities::getAeronauticalNightDeltaTsAsHM(),'3600'=>'1 h','7200'=>'2 h','10800'=>'3 h','21600'=>'6 h','43200'=>'12 h','86400'=>'24 h'],App\Helpers\TMAUtilities::getSunsetDeltaTs(),['class'=>'block mt-1 w-full '.$_validity_s_initial_class,'disabled' => (($state_id->statemessage->id == 2)?false:true) ]); !!}
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