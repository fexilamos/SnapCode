import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import 'bootstrap';

window.FullCalendar = { Calendar, dayGridPlugin, interactionPlugin };
