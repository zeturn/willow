<div class="flex justify-center">
    <form wire:submit.prevent="updateProfile" class="md:w-3/4 bg-white p-6">
        <div class="form-group p-1">
            <label for="real_name" class="text-sm font-medium text-gray-700">{{ __('basic.Real Name') }}:</label>
            <input type="text" id="real_name" wire:model="realName" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="form-group p-1">
            <label for="country" class="text-sm font-medium text-gray-700">{{ __('basic.Country') }}:</label>
            <select id="country" wire:model="country" class="form-control mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                @foreach ($countries as $country => $countryCode)
                    <option value="{{ $countryCode }}">{{$country }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group p-1">
            <label for="language" class="text-sm font-medium text-gray-700">{{ __('basic.Language') }}:</label>
            <select id="language" wire:model="language" class="form-control mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                @foreach ($languages as $languageName => $languageCode)
                    <option value="{{ $languageCode }}">{{$languageName }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group p-1">
            <label for="birthdate" class="text-sm font-medium text-gray-700">{{ __('basic.Birth') }}:</label>
            <input type="date" id="birthdate" wire:model="birthdate" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="form-group p-1">
            <label for="gender" class="text-sm font-medium text-gray-700">{{ __('basic.Gender') }}:</label>
            <select id="gender" wire:model="gender" class="form-control mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="female">Attack Helicopter</option>
                <option value="female">Walmart shopping bag</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group p-1">
            <label for="signature" class="text-sm font-medium text-gray-700">{{ __('basic.Signature') }}:</label>
            <input type="text" id="signature" wire:model="signature" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="form-group p-1">
            <label for="links" class="text-sm font-medium text-gray-700">{{ __('basic.Link') }}:</label>
            <input type="text" id="links" wire:model="links" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="form-group">
            <x-button type="submit" class="btn btn-primary mt-4">{{ __('basic.Save') }}</x-button>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </form>
</div>
