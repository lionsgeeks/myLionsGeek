<div x-data="{
    {{-- variable that will hold FullCalendar --}}
    calendar: null,
        {{-- variable for day Filter --}}
    date: @entangle('date'),
        {{-- my Events --}}
    events: @entangle('events'),
        {{-- Variable for place filter --}}
    placeID: @entangle('placeID'),
        {{-- Enable Edit and Select on FullCalendar only when user choses a place --}}
    isEditable: false,
        checkEditable() {
            this.isEditable = this.placeID !== '';
            this.calendar.setOption('editable', this.isEditable);
            this.calendar.setOption('selectable', this.isEditable);
        },

        initializeCalendar() {
            this.calendar = new FullCalendar.Calendar(this.$refs.calendar, {
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
                selectable: this.isEditable,
                {{-- if the selected event overlap or not --}}
                selectOverlap: false,
                {{-- dont allow old dates --}}
                selectAllow: (info) => {
                    let today = new Date();
                    return (info.start < today) ? false : true
                },
                {{-- what happens when the user selects an area in the calendar --}}
                select: (info) => {
                    {{-- TODO: cant update if event has passed --}}
                    $wire.save(info, this.placeID);
                },

                {{-- The events for the calendar --}}
                events: this.events,

                {{-- if the events can be edited: moved/resized --}}
                editable: this.isEditable,
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

                },

            });
            this.calendar.render();
        },

        {{-- function to render the events without refreshing the page --}}
    reRenderEvents(ev) {
            this.calendar.removeAllEvents();
            this.calendar.addEventSource(ev);
            this.calendar.refetchEvents();
        },

}" x-init="initializeCalendar()" x-on:listen='reRenderEvents($event.detail.events)'>

    <p>This is a basic example of how the cowork reservation would look like</p>
    <p>can only reserve if the user chose a place from the select</p>
    <small>(currently only places of type cowork)</small>
    <p>can filter by day (just for fun)</p>
    <div class="mb-5">
        <select @change="checkEditable" wire:model.change='placeID' class="rounded">
            <option value="">All</option>
            @foreach ($this->coworks as $cow)
                <option value="{{ $cow->id }}">{{ $cow->name }}</option>
            @endforeach
        </select>

        <input type="date" wire:model.live='date' class="rounded">

        <button x-on:click="reRenderEvents(events)" class="bg-black px-3 py-2 text-white rounded">Reset Filters</button>
    </div>

    <div wire:ignore x-ref='calendar'></div>


    {{-- this is for later --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div
                class="bg-gray-900 rounded-lg p-6 w-[90%] max-w-lg shadow-2xl transform transition-transform duration-300 scale-100">
                <h2 class="text-xl font-bold mb-4 text-alpha border-b pb-2">Reservation Modal</h2>


            </div>
        </div>
    @endif

</div>
