<div class="js-cookie-consent flex fixed w-full h-full top-0 left-0 bg-gray-800 bg-opacity-75">
    <div class="js-cookie-consent w-full p-5 lg:px-24 absolute bottom-0 bg-gray-600 flex justify-between">
        <div class="ml-4 text-sm leading-7"><a href={{route('gdpr')}} class="underline text-gray-900 dark:text-white">{{__("Privacy statement")}}</a></div>
        <div>
            <label for="js-cookie-consent-agree" class="cookie-consent__message text-sm text-white py-2 text-right">
                {{ __('This wesite use cookies') }}
            </label>

            <button name="js-cookie-consent-agree" class="js-cookie-consent-agree py-2 px-8 bg-green-400 hover:bg-green-500 text-white rounded font-bold text-sm shadow-xl">
                {{ __('Allow cookies') }}
            </button>
        </div>
    </div>
</div>
