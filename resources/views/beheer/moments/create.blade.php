<x-app-layout>
    <x-slot name="header">
        <h2>
            @section('title', 'Nieuwe examen moment toevoegen')
            @yield('title')
        </h2>
    </x-slot>

    @livewire('includes.content.top.content-normal-top') 

        <a href="{{ route('examens.show', $examen['id']) }}" class="a-clear mb-2">
            <x-jet-button class="mb-2 button">
                {{ __('Terug naar examen') }}
            </x-jet-button>
        </a>

        <form method="post" action="{{ url('beheer/examenMomentStore/'.$examen['id'] )}}" enctype="multipart/form-data">

            @csrf
            
            <div class="col-md-6">
                <div class="form-group">
                    <lable for="datum" class="block font-medium text-sm text-gray-700">Datum</lable>
                    @error('datum')<div class="fc-red text-sm">{{ $message }}</div>@enderror
                    <input id="datum" class="block mt-1 w-full form-control" type="date" name="datum" :value="old('datum')"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <lable for="tijd" class="block font-medium text-sm text-gray-700">Tijdstippen</lable>
                        @error('tijd')<div class="fc-red text-sm">{{ $message }}</div>@enderror
                        <input id="tijd" class="block mt-1 w-full form-control" type="time" name="tijd" :value="old('tijd')"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <lable for="plaatsen" class="block font-medium text-sm text-gray-700">Beschikbare plekken</lable>
                        @error('plaatsen')<div class="fc-red text-sm">{{ $message }}</div>@enderror
                        <input id="plaatsen" class="block mt-1 w-full form-control" type="number" name="plaatsen" :value="old('plaatsen')"/>
                    </div>
                </div>

                <div class="form-group">
                    <x-jet-button class="mb-2 button">
                        {{ __('Examen moment toevoegen') }}
                    </x-jet-button>
                </div>
            </div>
        </form>

    @livewire('includes.content.bottom.content-bottom') 

</x-app-layout>