import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import bootstrapPlugin from '@fullcalendar/bootstrap';
import listPlugin from '@fullcalendar/list';
import idLocale from '@fullcalendar/core/locales/id';

// window.onload = function() {
//     getMap();
// };
function yoman(input = moment()) {
    const weekOfYear = input.weeks();
    const weekOfYearNextMonth = input.add(1, "month").startOf("month").weeks();

    if (weekOfYear === weekOfYearNextMonth) {
        return true;
    }

    return false;
}

function weekOfMonth (input = moment()) {
    const firstDayOfMonth = input.clone().startOf('month');
    const firstDayOfWeek = firstDayOfMonth.clone().startOf('isoWeek');

    const offset = firstDayOfMonth.diff(firstDayOfWeek, 'days');

    return Math.ceil((input.date() + offset) / 7);
}

function getISOWeekInMonth(date) {
    // Copy date so don't affect original
    var d = new Date(+date);
    if (isNaN(d)) return;
    // Move to previous Monday
    d.setDate(d.getDate() - d.getDay() + 1);
    // Week number is ceil date/7
    return {month: +d.getMonth()+1,
        week: Math.ceil(d.getDate()/7)};
}

const CalendarApp = function() {
    this.$body = $("body")
    this.$calendar = document.getElementById("calendar"),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$modal = $('#my-event'),
        this.$calendarObj = null
}

CalendarApp.prototype.onSelect = function(info) {
    console.log("test");
},
    CalendarApp.prototype.onDateClick = function(info, self) {
        let events = self.$calendarObj.getEvents().filter(function(event) {
            return (moment(event.extendedProps.tglMulai).format("YYYY-MM-DD")
                    <= moment(event.start).format("YYYY-MM-DD")
                    && moment(event.start).format("YYYY-MM-DD")
                    === moment(info.date).format("YYYY-MM-DD")
                    && event.extendedProps.weeks
                    && event.extendedProps.weeks.includes(weekOfMonth(moment(info.date)).toString())
                    || event.extendedProps.tglJemput && moment(event.extendedProps.tglJemput).format("YYYY-MM-DD")
                        === moment(info.date).format("YYYY-MM-DD"));
        });

        if (events.length !== 0) {
            let modal = $("#mapModal");
            modal.find('.modal-body').empty();
            modal.modal("show");
            console.log(events);
            $.each(events, function(index, item) {
                let checkJemput = !item.extendedProps.tglJemput ? 'd-none' : '';
                let detailJemput = `
                    <p class="mb-2">Tanggal Jemput: ${moment(item.extendedProps.tglJemput).format('dddd, D MMMM YYYY')}</p>
                    <p class="mb-2">Armada: ${item.extendedProps.armada}</p>
                    <p class="mb-2">Driver: ${item.extendedProps.driver}</p>
                    <p class="m-0">Status: ${item.extendedProps.status}</p>
                `;
                modal.find('.modal-body').append(
                    `
                        <div class="card border">
                            <div class="card-body">
                                <p class="mb-2">Nama Nasabah: ${item.title}</p>
                                <p class="mb-2">Alamat: ${item.extendedProps.alamat}</p>
                                <p class="mb-0">No Telepon: ${item.extendedProps.no_telp}</p>
                                <div class="accordion mt-4 ${checkJemput}" id="accordionJemput${item.id}">
                                    <a href="#" id="accHeading" data-toggle="collapse" data-target="#collapseJemput${item.id}">Detail Jemput</a>
                                    <div id="collapseJemput${item.id}" class="collapse mt-2">
                                        ${detailJemput}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
            });
            // let locs = [];
            //
            // for (let i = 0; i < events.length; i++) {
            //     locs[i] = new Microsoft.Maps.Location(events[i].extendedProps.latitude, events[i].extendedProps.longitude);
            //     let pin = new Microsoft.Maps.Pushpin(locs[i]);
            //     map.entities.push(pin);
            //     new Microsoft.Maps.Events.addHandler(pin, 'click', function (e) { console.log(e.originalMap); });
            // }
            //
            // var bounds = Microsoft.Maps.LocationRect.fromLocations(locs);
            // map.setView({ bounds: bounds });
        }
    },
    CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
        //
    }

CalendarApp.prototype.init = function(data) {
    // this.enableDrag();
    /*  Initialize the calendar  */
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var form = '';
    var today = new Date($.now());

    var defaultEvents = [];

    console.log(data);

    data.jadwal_data.forEach(function(item, index) {
        item.days.split(';').map(function(day, index) {
            defaultEvents.push({
                id: item.id,
                title: item.nasabah.name,
                daysOfWeek: day.split(','),
                description: '',
                constraint: item.nasabah.name,
                weeks: item.weeks.split(';')[index],
                tglMulai: item.created_at,
                alamat: item.nasabah.user.alamat ? item.nasabah.user.alamat.address : null,
                no_telp: item.nasabah.user ? item.nasabah.user.phone_number : null,
                backgroundColor: '#2255a4',
                borderColor: '#2255a4',
            });
        });
    });

    data.jemput_data.forEach(function(item, index) {
        let bgColor = '';
        let borderColor = '';
        let detailJemput = {};

        if (item.status_id === 13) { // Belum dijemput
            bgColor = '#ffb848';
            borderColor = '#ffb848';
            detailJemput = {
                armada: item.fleet,
                driver: item.setoran_jemput.pegawai.name,
                status: item.status.name,
            };
        }

        if (item.status_id === 12) { // Belum dikonfirmasi
            bgColor = '#da542e';
            borderColor = '#da542e';
        }

        if (item.status_id === 9) { // Dijemput
            bgColor = '#343a40';
            borderColor = '#343a40';
            detailJemput = {
                armada: item.fleet,
                driver: item.setoran_jemput.pegawai.name,
                status: item.status.name,
            };
        }

        if (item.status_id === 7) { // Dijemput
            bgColor = '#28b779';
            borderColor = '#28b779';
            detailJemput = {
                armada: item.fleet,
                driver: item.setoran_jemput.pegawai.name,
                status: item.status.name,
            };
        }

        defaultEvents.push({
            id: item.id,
            title: item.setoran_jemput.setoran.nasabah.name,
            start: moment(item.date_pick_up).format('YYYY-MM-DD'),
            tglMulai: item.date_pick_up,
            tglJemput: item.date_pick_up,
            alamat: item.setoran_jemput.setoran.nasabah.user.alamat ? item.setoran_jemput.setoran.nasabah.user.alamat.address : null,
            no_telp: item.setoran_jemput.setoran.nasabah.user ? item.setoran_jemput.setoran.nasabah.user.phone_number : null,
            backgroundColor: bgColor,
            borderColor: borderColor,
            ...detailJemput
        });
    });

    // for (var i = data.length - 1; i >= 0; i--) {
    //     if (data[i].days.includes(';')) {
    //         for (var j = data[i].days.split(';').length - 1; j >= 0; j--) {
    //             defaultEvents.push({
    //                 title: data[i].nasabah.name,
    //                 daysOfWeek: [data[i].days.split(';')[j]],
    //                 description: data[i].nasabah.name,
    //                 constraint: 'Langganan',
    //                 weeks: data[i].weeks.split(';')[j],
    //                 tglMulai: data[i].created_at,
    //                 alamat: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.address : null,
    //                 longitude: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.longitude : null,
    //                 latitude: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.latitude : null
    //             });
    //         }
    //     } else {
    //         defaultEvents.push({
    //             title: data[i].nasabah.name,
    //             daysOfWeek: [data[i].days],
    //             description: data[i].nasabah.name,
    //             constraint: 'Langganan',
    //             weeks: data[i].weeks.split(';'),
    //             tglMulai: data[i].created_at,
    //             alamat: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.address : null,
    //             longitude: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.longitude : null,
    //             latitude: data[i].nasabah.user.alamat ? data[i].nasabah.user.alamat.latitude : null
    //         });
    //     }
    // }

    var $this = this;
    $this.$calendarObj = new Calendar(this.$calendar, {
        locale: idLocale,
        plugins: [ bootstrapPlugin, dayGridPlugin, listPlugin, interactionPlugin ],
        themeSystem: 'bootstrap',
        slotDuration: '00:15:00',
        /* If we want to split day time each 15minutes */
        minTime: '08:00:00',
        maxTime: '19:00:00',
        handleWindowResize: true,
        fixedWeekCount: false,
        firstDay: 1,
        defaultDate: moment().add(3, "month").startOf("month").format("YYYY-MM-DD"),

        header: {
            left: '',
            center: 'title',
            right: ''
        },
        views: {
            listMonth: {
                buttonText: {
                    month: 'bulan',
                    today: 'hari'
                }
            },
            fuckWeek: {
                type: 'dayGridWeek',
                duration: { weeks: 5 },
                currentStart: moment().startOf("month").format("YYYY-MM-DD"),
            },
            listDay: { buttonText: 'list harian' },
            listWeek: { buttonText: 'list mingguan' }
        },
        defaultView: 'fuckWeek',

        events: defaultEvents,
        eventTextColor: '#fff',
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        eventRender: function(info) {
            /*if (moment() > moment(info.event.start).add(1, 'days')) {
                $(info.el).attr({
                    style: 'background-color: #ccc !important;border-color: #ccc !important'
                });
            }*/

            /*if (info.event.extendedProps.weeks && !info.event.extendedProps.weeks.includes(weekOfMonth(moment(info.event.start)).toString())) {
                $(info.el).hide();
            }*/
            $(info.el).hide();

            if (yoman(moment(info.event.start))) {
                $(info.el).show();
            }

            if (new Date(info.event.extendedProps.tglMulai).setDate(new Date(info.event.extendedProps.tglMulai).getDate() - 1) > info.event.start) {
                $(info.el).hide();
            }

        },
        drop: function(date) { $this.onDrop($(this), date); },
        eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); },
        dateClick: function(info) { $this.onDateClick(info, $this) }

    });

    $this.$calendarObj.render();

},
    //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp;

document.addEventListener('DOMContentLoaded', function() {
    moment.locale('id');
    var jadwal = function() {
        return $.ajax({
            type: "POST",
            url: window.location.origin+"/api/jadwals",
            dataType: "json",
            data: {
                "banksampah_id": bsId
            }
        });
    };

    jadwal().then(function(jadwal_data) {
        $.ajax({
            type: "POST",
            url: window.location.origin+"/api/jemputs",
            dataType: "json",
            data: {
                "banksampah_id": bsId
            },
            success: function(data) {
                $.CalendarApp.init({
                    'jadwal_data': jadwal_data.filter(function(item) {
                        return item.status_id === 5;
                    }),
                    'jemput_data': data
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
});
