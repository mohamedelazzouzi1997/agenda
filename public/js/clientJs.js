        const ToasterOptions = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'fr', // change calendare to fr lang
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridYear,dayGridMonth,dayGridWeek,dayGridDay,list'
                },
                dayMaxEvents: 3, // for all non-TimeGrid views
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semain',
                    day: 'Jour',
                    list: 'list',
                    year: 'Année',
                },
                eventTextColor: 'black',
                navLinks: true,
                // editable: true,
                selectable: true,
                initialDate: Date.now(),
                eventDidMount: function(info) {
                    $(info.el).tooltip({
                        title: info.event.extendedProps.description,
                        placement: "top",
                        trigger: "hover",
                        container: "body"
                    });
                },
                events: '/getEvents',
                eventClick: function(info) {
                    // alert(info.event.classNames);
                    var currentDate = info.event.start;

                    var month = currentDate.getMonth() + 1;
                    if (month < 10) month = "0" + month;

                    var dateOfMonth = currentDate.getDate();
                    if (dateOfMonth < 10) dateOfMonth = "0" + dateOfMonth;
                    var year = currentDate.getFullYear();

                    var hour = currentDate.getHours();
                    if (hour < 10) hour = "0" + hour;

                    var minute = currentDate.getMinutes();
                    if (minute < 10) minute = "0" + minute;

                    var formattedDate = year + "/" + month + "/" + dateOfMonth + ' ' + hour + ':' +
                        minute;

                    const title = info.event.title;
                    const statusBgColor = info.event.classNames;
                    const description = info.event.extendedProps.description;
                    const start = formattedDate;
                    const status = info.event.extendedProps.status;
                    const eventId = info.event.id;

                    $('#editEventTile').val(title);
                    $('#editeventDate').html(start);
                    $('#eventstatus').html(status);
                    if ($('#eventstatus').hasClass('has-bg')) {
                        $('#eventstatus').removeClass('bg-enatend');
                        $('#eventstatus').removeClass('bg-rejete');
                        $('#eventstatus').removeClass('bg-valide');
                    }
                    $('#eventstatus').addClass(statusBgColor);
                    $('#eventstatus').addClass('has-bg');
                    $('#editEventDescription').val(description);
                    $('#editNotification').modal();

                    $('#editmyform').attr('action', '/event/update/' + eventId);

                },
                select: function(selectionInfo) {
                    $('#eventDate').val(selectionInfo.startStr + 'T00:00');
                    $('#addNotification').modal();
                }
            });
            calendar.render();
        });