<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Barangay Current Events</title>
    <style>
        body {
            background-color: #e7be08;
            font-family: Arial, sans-serif;
        }
        .header-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 20px;
        }
        #events-count h2 {
            text-align: center;
            font-size: 1.5rem;
            color: #333;
        }
        .add-event-form {
            background-color: #fdfdfd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        .add-event-form h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }
        .btn-submit {
            background-color: #4caf50;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .event {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            position: relative;
        }
        .event-title {
            font-size: 1.5rem;
            color: #333;
            margin-top: 0;
        }
        .event-date, .event-description {
            color: #666;
            font-size: 1rem;
        }
        .delete-btn {
            background-color: #ff5c5c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #e14a4a;
        }
    </style>            
</head>
<body>
    <?php 
        include 'C:\xampp\htdocs\BRGY SYSTEM\assets\php\header.html';
    ?> 

    <div class="container">
        <h1 class="header-title">Barangay Current Events</h1>

        <div id="events-count" class="my-3">
            <h2>Total Current Events: <span id="totalEvents">2</span></h2>
        </div>
        <div class="add-event-form">
            <h2>Add New Event</h2>
            <form id="eventForm">
                <div class="form-group">
                    <label for="eventTitle">Event Title</label>
                    <input type="text" id="eventTitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="eventDate">Event Date</label>
                    <input type="date" id="eventDate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="eventDescription">Event Description</label>
                    <textarea id="eventDescription" class="form-control" rows="3" required></textarea>
                </div>
                <button type="button" class="btn btn-submit" onclick="addEvent()">Add Event</button>
            </form>
        </div>

        <div id="events-section"></div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        function updateEventCount() {
            const totalEvents = document.getElementsByClassName("event").length;
            document.getElementById("totalEvents").textContent = totalEvents;
        }

        updateEventCount();

        function addEvent() {
            const title = document.getElementById("eventTitle").value;
            const date = document.getElementById("eventDate").value;
            const description = document.getElementById("eventDescription").value;

            if (title === "" || date === "" || description === "") {
                alert("Please fill in all fields.");
                return;
            }

            const newEvent = document.createElement("div");
            newEvent.classList.add("event");

            newEvent.innerHTML = `
                <button class="delete-btn" onclick="deleteEvent(this)">Delete</button>
                <h2 class="event-title">${title}</h2>
                <p class="event-date">Date: ${date}</p>
                <p class="event-description">${description}</p>
            `;
            document.getElementById("events-section").appendChild(newEvent);

            document.getElementById("eventForm").reset();
        }

        function deleteEvent(button) {
            const event = button.parentElement;
            document.getElementById("events-section").removeChild(event);

            updateEventCount();
        }
    </script>
</body>
</html>
