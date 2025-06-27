@extends('layouts.dashboard')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <style>
       #calendar {
    min-height: 600px;
    background: #334155;
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

/* Permitir quebra de linha no título do evento */
.fc-event-title, .fc-event-title-container {
    white-space: normal !important;
    overflow-wrap: break-word !important;
    word-break: break-word !important;
}

/* Cabeçalho com os nomes dos dias da semana */
.fc-col-header-cell {
    background-color: #1e293b !important;
    color: #ffffff !important;
}

/* Linhas e colunas do calendário */
.fc td, .fc th {
    border: 1px solid #1e293b !important;
    background-color: #334155 !important;
    color: #ffffff !important;
}

/* Barra do topo (navegação entre meses e título do mês) */
.fc-toolbar {
    background-color: #1e293b !important;
    color: #ffffff !important;
    padding: 10px;
    border-bottom: 1px solid #1e293b;
}

/* Botões de navegação */
.fc-button {
    background-color: #1e293b !important;
    color: #ffffff !important;
    border: 1px solid #0f172a !important;
}
.fc-button:hover {
    background-color: #0f172a !important;
}

/* Eliminar qualquer fundo branco escondido */
.fc .fc-scrollgrid {
    background-color: #334155 !important;
}
/* Remove fundo branco no topo (linhas ocultas ou margens do scrollgrid) */
.fc .fc-scrollgrid-section-header,
.fc .fc-scrollgrid-section-body,
.fc .fc-daygrid-body {
    background-color: #334155 !important;
}

/* Remove margens internas escondidas no scrollgrid */
.fc .fc-scrollgrid {
    border: none !important;
}

/* Garante que a área geral do calendário fica sem margens/padding brancos */
.fc-view-harness {
    background-color: #334155 !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* Garante que o container geral também assume o fundo escuro */
.fc-view {
    background-color: #334155 !important;
}
    </style>
@endpush

@section('content')
    <h1 class="text-2xl font-bold mb-4 font-mono">Calendário de Eventos</h1>
    <div id="calendar" class="p-4 rounded shadow font-mono"></div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                const eventos = @json($eventos ?? []);
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'pt',
                    height: 'auto',
                    events: eventos
                });
                calendar.render();
            } else {
                console.error('FullCalendar: #calendar not found');
            }
        });
    </script>
@endpush
