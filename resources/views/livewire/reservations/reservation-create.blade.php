<div x-data="{
    calendar: null,
    dayFilter: null,

    events: {{ json_encode($this->reservations) }},
    initializeCalendar() {
        let calendarEl = document.getElementById('calendar');
        this.calendar = new FullCalendar.Calendar(calendarEl, {
            {{-- starting View --}}
            initialView: 'timeGridWeek',
            {{-- time indicator --}}
            nowIndicator: true,
            {{-- if events overlap or not --}}
            eventOverlap: true,

            {{-- the timeslot of allDay events --}}
            allDaySlot: false,
            {{-- buttons in the header of the calendar --}}
            headerToolbar: {
                left: 'prev,next today,dayGridMonth,timeGridWeek,timeGridDay',
                center: 'title',
                right: 'listMonth,listWeek,listDay'
            },
            {{-- name of the buttons in the header of the calendar --}}
            views: {
                listDay: {
                    buttonText: 'Day Events'
                },
                listWeek: {
                    buttonText: 'Week Events'
                },
                listMonth: {
                    buttonText: 'Month Events'
                },
                timeGridWeek: {
                    buttonText: 'Week',
                },
                timeGridDay: {
                    buttonText: 'Day',
                },
                dayGridMonth: {
                    buttonText: 'Month',
                },
            },

            {{-- if user can select a part of the calendar --}}
            selectable: true,
            {{-- if the select overlap or not --}}
            selectOverlap: false,
            {{-- what select to allow --}}
            selectAllow: (info) => {
                let today = new Date();
                return (info.start < today) ? false : true
            },
            {{-- what happens when the user selects an area in the calendar --}}
            select: (info) => {
                $wire.save(info);
            },

            {{-- The events for the calendar --}}
            events: this.events,

            {{-- if the events can be edited: moved/resized --}}
            editable: true,
            {{-- what to do when an event is dropped --}}
            eventDrop: (event) => {
                const eventStartDate = event.event.start;
                const today = new Date();
                if (eventStartDate < today) {
                    event.revert();
                } else {
                    $wire.updateEvent(event)
                }
            },
            {{-- what to do when an event is resized --}}
            eventResize: (event) => {
                $wire.updateEvent(event)
            },

            {{-- Content of an event in the calendar: added a button to delete an event --}}
            eventContent: function(arg) {
                let timeText = document.createElement('span');
                timeText.innerText = arg.timeText + ' ' + arg.event.title;

                let deleteButton = document.createElement('span');
                deleteButton.innerHTML = `
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='#f00' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                    <polyline points='3 6 5 6 21 6'></polyline>
                    <path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6'></path>
                    <line x1='10' y1='11' x2='10' y2='17'></line>
                    <line x1='14' y1='11' x2='14' y2='17'></line>
                    <path d='M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2'></path>
                </svg>`;
                deleteButton.style.cursor = 'pointer';
                deleteButton.style.marginLeft = '5px';
                deleteButton.style.fontSize = '12px';

                deleteButton.addEventListener('click', function(e) {
                    e.stopPropagation();

                    $wire.deleteEvent(arg);

                    arg.event.remove();
                });

                let container = document.createElement('div');
                container.style.display = 'flex';
                container.style.justifyContent = 'space-between';
                container.style.alignItems = 'center';

                container.appendChild(timeText);
                container.appendChild(deleteButton);

                return { domNodes: [container] };
            },

            {{-- what happens when an event is clicked --}}
            eventClick: () => {
                {{-- $dispatch('open-modal', 'reservation-modal') --}}
            },

        });
        this.calendar.render();
    },

    reRenderEvents() {
        this.calendar.removeAllEvents();
        this.calendar.addEventSource(this.events);
        this.calendar.refetchEvents();
    },
    filterEventsByDay(events, day) {
        return events.filter(event => {
            const eventDate = event.start.split('T')[0];
            return eventDate === day;
        });
    },
    filterEvents() {
        const filteredEvents = this.filterEventsByDay({{ json_encode($this->reservations) }}, this.dayFilter);
        this.events = filteredEvents;

        this.reRenderEvents();
    },

    resetEvents() {
        this.events = {{ json_encode($this->reservations) }}
        this.reRenderEvents();
    }


}" x-init="initializeCalendar()">

    <input type="date" name="dayFilter" id="dayFilter" x-model='dayFilter' @change='filterEvents'>

    <button x-on:click="resetEvents()" class="bg-black px-3 py-1 text-white rounded">Reset Filters</button>

    <div wire:ignore id="calendar"></div>

    <x-modal name="reservation-modal" class="p-3">
        <p>This is a modal</p>
        <button x-on:click="$dispatch('close')">
            Cancel
        </button>

        <form wire:submit.prevent='save' class="flex flex-col gap-2">
            <!-- Start time input -->
            <input type="datetime-local" name="start" id="start" wire:model="start" required>

            <!-- End time input -->
            <input type="datetime-local" name="end" id="end" wire:model="end" required>

            <button type="submit">Create</button>
        </form>
    </x-modal>

    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div
                class="bg-gray-900 rounded-lg p-6 w-[90%] max-w-lg shadow-2xl transform transition-transform duration-300 scale-100">
                <h2 class="text-xl font-bold mb-4 text-alpha border-b pb-2">Reservation Modal</h2>


            </div>
        </div>
    @endif

</div>
