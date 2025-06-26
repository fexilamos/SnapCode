@extends('layouts.dashboard')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <style>
        #calendar {
            min-height: 600px;
            background: #fff;
            color: #222;
            /* Removido o border de debug */
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    </style>
@endpush

@section('content')
    <h1 class="text-2xl font-bold mb-4">Calendário de Eventos</h1>
    <div id="calendar" class="p-4 rounded shadow"></div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'pt',
                    height: 'auto'
                });
                calendar.render();
            } else {
                console.error('FullCalendar: #calendar not found');
            }
        });
    </script>
@endpush
