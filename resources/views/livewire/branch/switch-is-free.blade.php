<div class="pb-4 mb-4 border-b dark:border-gray-700">
    <div class="font-bold">{{ _('Whether to open for public editing') }}</div>
    <div x-data="{ switchOn: @entangle('isFree') }" class="flex items-center justify-center space-x-2">
        <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

        <button 
            x-ref="switchButton"
            type="button" 
            @click="switchOn = !switchOn; $wire.toggleIsFree()"
            :class="switchOn ? 'bg-blue-600' : 'bg-neutral-200'" 
            class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10"
            x-cloak>
            <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
        </button>

        <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')" 
            :class="{ 'text-blue-600': switchOn, 'text-gray-400': !switchOn }"
            class="text-sm select-none"
            x-cloak>
            {{ _('Turn on public edit') }}
        </label>
    </div>
</div>
