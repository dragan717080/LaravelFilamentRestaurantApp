<div {{ $attributes }} class="">
    <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]" wire:key="M78eObpL0Wuuuag8B1Se.data.measure_unit.Filament\Forms\Components\Select">
        <div class="">
            <div class="grid gap-y-2">
                <div class="flex items-center justify-between gap-x-3">
                    <label class="inline-flex items-center gap-x-3" for="data.measure_unit">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Measure unit    
                        </span>
                    </label>
                </div>
                <div class="w-fit">
                    <div class="flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus-within:ring-2 dark:bg-white/5 ring-gray-950/10 focus-within:ring-primary-600 dark:ring-white/20 dark:focus-within:ring-primary-500">
                        <select class="block border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 ps-3" id="data.measure_unit" wire:model="data.measure_unit">
                            <option value=""> Select an option</option>
                            @foreach ($getOptions() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $getChildComponentContainer() }}
</div>
