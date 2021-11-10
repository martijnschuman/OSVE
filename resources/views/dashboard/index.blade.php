<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('includes.content.top.content-wide-top') 


        <div class="pagination justify-content-center">
            <a href="#1" class="activePage" id="pagButtonOne" title="Studenten" onclick="pagination('1')"><i class="fas fa-user-graduate"></i> Ingeplande examens</a>
            <a href="#2" class="" id="pagButtonTwo" title="Docenten" onclick="pagination('2')"><i class="fas fa-chalkboard-teacher"></i> Alle examens</a>
            <a href="#3" class="" id="pagButtonThree" title="Klassen" onclick="pagination('3')"><i class="fas fa-school"></i> Opleidingen</a>
        </div>

        <br>

        <div id="elementOne">
            <h3>Ingeplande examens</h3>
            <table class="table table-bordered" style="margin: 10px 0 10px 0;" id="ingeplandeExamens">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Faciliteitenpas</th>
                        <th>Klas</th>
                        <th>Examen</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Student bevestigd</th>
                        <th>Docent bevestigd</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($geplandeExamens as $geplandExamen)
                    <tr>
                        <td>
                            {{ $geplandExamen->voornaam }}  {{ $geplandExamen->achternaam }} <small>({{ $geplandExamen->studentnummer }})</small>
                        </td>
                        <td>
                            {{ $geplandExamen->faciliteitenpas }}
                        </td>
                        <td>
                            {{ $geplandExamen->klas }}
                        </td>
                        <td>
                            {{ $geplandExamen->gepland_examen }}
                        </td>
                        <td>
                            {{ $geplandExamen->datum }}
                        </td>
                        <td>
                            {{ $geplandExamen->tijd }}
                        </td>
                        <td>
                            @if($geplandExamen->std_bevestigd == '1')
                                <p class="fc-primary-nh">Bevestigd</p>
                            @else
                                <p class="fc-secondary-nh" title="Examen is nog niet bevestigd door de student">Niet bevestigd</p>
                            @endif
                        </td>
                        <td>
                            @if($geplandExamen->doc_bevestigd == '1')
                                <p class="fc-primary-nh">Bevestigd</p>
                            @else
                                <form action="{{ route('bevestigExamen', $geplandExamen->id) }}" method="post">
                                    @csrf
                                    <x-jet-button class="button">
                                    Bevestigen
                                    </x-jet-button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="elementTwo" style="display: none;">
            <h3>Actieve examens</h3>
            <table class="table table-bordered" style="margin: 10px 0 10px 0;" id="actieveExamens">
                <thead>
                    <tr>
                        <th>Vak</th>
                        <th>Examen</th>
                        <th>Geplande docent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examens as $examen)
                        <tr>
                            <td>
                                {{ $examen->vak }}
                            </td>
                            <td>
                                {{ $examen->examen }}
                            </td>
                            <td>
                                {{ $examen->geplande_docenten }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            <h3>Toekomstige examens</h3>
            <table class="table table-bordered" style="margin: 10px 0 10px 0;" id="toekomstigeExamens">
                <thead>
                    <tr>
                        <th>Vak</th>
                        <th>Examen</th>
                        <th>Geplande docent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examens as $examen)
                        <tr>
                            <td>
                                {{ $examen->vak }}
                            </td>
                            <td>
                                {{ $examen->examen }}
                            </td>
                            <td>
                                {{ $examen->geplande_docenten }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="elementThree" style="display: none;">
            <h3>Opleidingen</h3>
            <table class="table table-bordered" style="margin: 10px 0 10px 0;" id="opleidingen">
                <thead>
                    <tr>
                        <th>Crebo nummer</th>
                        <th>Opleiding</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opleidingen as $opleiding)
                    <tr>
                        <td>
                            {{ $opleiding->crebo_nr }}
                        </td>
                        <td>
                            {{ $opleiding->opleiding }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</x-app-layout>

<script>
$(document).ready(function() {
    $('#ingeplandeExamens').DataTable( {
        "language": {
            "url": "{{asset('/json/datatabels/dutch')}}"
        }
    });
    $('#actieveExamens').DataTable( {
        "language": {
            "url": "{{asset('/json/datatabels/dutch')}}"
        }
    });
    $('#toekomstigeExamens').DataTable( {
        "language": {
            "url": "{{asset('/json/datatabels/dutch')}}"
        }
    });
    $('#opleidingen').DataTable( {
        "language": {
            "url": "{{asset('/json/datatabels/dutch')}}"
        }
    });
});
</script>