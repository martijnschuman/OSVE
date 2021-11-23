{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('moments.destroy', $moment->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Weet je het zeker dat je het moment van "{{ $moment->tijd }}" op "{{ $moment->datum }}" wilt verwijderen?</h5>
    </div>
    <div class="modal-footer-custom">
            <div class="mt-4">
                <a data-bs-dismiss="modal" class="fc-h-white a-clear float-left mb-2 button inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition button float-right">
                    <i class="fas fa-backward mr-2" ></i> Cancel
                </a>
                <x-jet-button class="button float-right">
                    Ja, verwijder het examen moment <i class="fas fa-forward ml-2"></i> 
                </x-jet-button>
            </div>
    </div>
</form>