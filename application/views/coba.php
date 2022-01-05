<html>

<head>
    <title>My Evo Calendar</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/plugin/event-calendar-evo/css/evo-calendar.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/plugin/event-calendar-evo/css/evo-calendar.midnight-blue.css" />
</head>

<body>
    <div id="calendar"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/plugin/event-calendar-evo/js/evo-calendar.js"></script>

    <script>
        let today = new Date();
        console.log();
        // initialize your calendar, once the page's DOM is ready
        $(document).ready(function() {
            $('#calendar').evoCalendar({
                todayHighlight: true,
                calendarEvents: [{
                        id: 'evebt1', // Event's ID (required)
                        name: "New Year", // Event name (required)
                        date: "January/1/2020", // Event date (required)
                        description: "Vacation leave for 3 days.", // Event description (optional)
                        type: "holiday", // Event type (required)
                        everyYear: true, // Same event every year (optional)
                        color: "#FF0000" // Event custom color (optional)
                    },
                    {
                        id: 'evebt2', // Event's ID (required)
                        name: "Vacation Leave",
                        badge: "02/13 - 02/15", // Event badge (optional)
                        date: ["2022-01-12", "2022-01-18"], // Date range
                        description: "Vacation leave for 3 days.", // Event description (optional)
                        type: "event",
                        color: "#63d867" // Event custom color (optional)
                    }
                ]
            })
            // add multiple events
            $('#calendar').evoCalendar('addCalendarEvent', [{
                    id: 'kNybja6',
                    name: 'Mom\'s Birthday',
                    date: 'Jan 27, 2022',
                    type: 'birthday',
                    everyYear: true // optional
                },
                {
                    id: 'asDf87L',
                    name: 'Graduation Day!',
                    date: 'March 21, 2022',
                    type: 'event'
                }
            ]);
        })
    </script>

</body>

</html>