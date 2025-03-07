<div class="pt-10 pb-10">
    <div class="bg-white w-[70vw] mx-auto p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4 border-b pb-2">📅 Calendar</h1>
        <div id='calendar' wire:ignore></div>
        <script type="text/javascript">
            document.addEventListener('livewire:initialized', () => {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    events: @json($attendances),
                    select: function(info) {
                        let selectedDate = info.startStr.split('T')[0];
        
                        Swal.fire({
                            title: "Confirmer la présence",
                            text: `Voulez-vous marquer votre présence pour le ${selectedDate} ?`,
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Oui, confirmer",
                            cancelButtonText: "Annuler",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('addAttendances', { attendance_day: selectedDate });
                                Swal.fire("Ajouté !", "Votre présence a été enregistrée.", "success");
                            }
                        });
                    }
                });
                calendar.render();
            });
        </script>
        

    </div>
</div>
