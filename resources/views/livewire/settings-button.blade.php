<div x-data="{
        open: false,
        dark: settings.dark
    }" x-init="
        () => $watch('open', value => {
            if (value === true) { document.body.classList.add('overflow-hidden') } 
            else { document.body.classList.remove('overflow-hidden') }
        });" class="ml-2">
    <button type="button"
        class="px-3 py-2 text-gray-600 duration-150 ease-in-out rounded-md focus:bg-gray-200 focus:outline-none focus:shadow-outline-gray hover:bg-gray-200 dark:text-gray-500 dark:hover:bg-gray-600"
        @click="open=true">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
            </path>
        </svg>
    </button>

    <div x-show="open" class="fixed inset-0 z-10 overflow-y-auto" style="display: none">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-description="Background overlay, show/hide based on modal state."
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div x-show="open" x-description="Modal panel, show/hide based on modal state."
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 dark:bg-gray-900"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-300" id="modal-headline">
                    Change settings
                </h3>
                
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button @click="open = false;" type="button"
                        class="text-gray-400 transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none focus:text-gray-500"
                        aria-label="Close">
                        <svg class="w-6 h-6" x-description="Heroicon name: x" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <div>
                    <div class="mt-3 sm:mt-5">
                        
                        <div class="flex flex-col mt-2">
                            <x-form.input-group
                                label="Preferred API"
                                for="api"
                                :error="$errors->first('settings.api')">
                                <select
                                    class="form-select dark:bg-gray-700 dark:text-gray-100"
                                    wire:model.defer="settings.api"
                                    name="api"
                                    id="api"
                                    required
                                    autofocus
                                >
                                    <option value="{{ \App\Models\User::SETTING_API_MAINNET }}">ARK Mainnet</option>
                                    <option value="{{ \App\Models\User::SETTING_API_DEVNET }}">ARK Devnet</option>
                                </select>
                            </x-form.input-group>
                            
                            <x-form.input-group
                                for="dark"
                                label="Enable dark mode"
                                :error="$errors->first('settings.dark')"
                            >
                                <div class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        wire:model.defer="settings.dark"
                                        class="form-checkbox"
                                        name="dark"
                                        id="dark"
                                    />
                                    <span class="text-gray-600 dark:text-gray-200">Enable</span>
                                </div>
                            </x-form.input-group>
                            
                        </div>
                    </div>
                </div>

                <div class="mt-5 sm:mt-6">
                    <span class="flex w-full rounded-md shadow-sm">
                        <x-button
                            wire:click="saveSettings"
                            type="button"
                            class="block"
                            class="w-full"
                        >
                            Save changes
                        </x-button>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
