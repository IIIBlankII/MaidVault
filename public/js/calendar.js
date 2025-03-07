function initializeCalendar() {
  // Sample events data - replace with your own logic or fetched data
  const eventData = window.events || {};

  // Initialize current month and year (months are 1-indexed in this script)
  let currentDate = new Date('2025-03-01');
  let currentMonth = currentDate.getMonth() + 1;
  let currentYear = currentDate.getFullYear();
  let selectedDate = null; // To keep track of a selected day (format YYYY-MM-DD)

  // DOM elements - these should exist in your HTML
  const calendarTitle = document.getElementById('calendar-title');
  const calendarGrid = document.getElementById('calendar-grid');
  const eventsDisplayDiv = document.getElementById('events-display'); // Dynamic events display container
  const prevBtn = document.getElementById('prev');
  const nextBtn = document.getElementById('next');
  const eventsTitle = document.getElementById('events-title');

  // Generate the calendar grid for a given month and year
  function generateCalendar(month, year) {
    // Clear any selected date since the calendar is being re-rendered
    selectedDate = null;

    // Update the title with the month name and year
    const dateObj = new Date(year, month - 1);
    const monthName = dateObj.toLocaleString('default', { month: 'long' });
    calendarTitle.textContent = `${monthName} ${year}`;

    // Clear previous calendar cells
    calendarGrid.innerHTML = '';

    // Create the first day of the month date object
    const firstDay = new Date(year, month - 1, 1);
    // JavaScript’s getDay() returns 0 (Sunday) to 6 (Saturday)
    // Adjust so that Monday (1) is the first day of the week:
    let startDay = firstDay.getDay();
    startDay = startDay === 0 ? 7 : startDay;

    // Fill in empty cells before the first day of the month
    for (let i = 1; i < startDay; i++) {
      const emptyCell = document.createElement('div');
      calendarGrid.appendChild(emptyCell);
    }

    // Determine number of days in the month
    const daysInMonth = new Date(year, month, 0).getDate();
    for (let day = 1; day <= daysInMonth; day++) {
      const cell = document.createElement('div');
      // Add common classes plus a marker class "calendar-day"
      cell.classList.add('calendar-day', 'p-2', 'border', 'rounded-md', 'hover:bg-blue-100', 'cursor-pointer');

      // Create day number element
      const daySpan = document.createElement('span');
      daySpan.classList.add('font-semibold');
      daySpan.textContent = day;

      // Build the date string (YYYY-MM-DD)
      const dayStr = day.toString().padStart(2, '0');
      const monthStr = month.toString().padStart(2, '0');
      const dateStr = `${year}-${monthStr}-${dayStr}`;

      // Create event indicator element (red dot)
      const eventDiv = document.createElement('div');
      eventDiv.classList.add('text-xs');
      if (eventData.hasOwnProperty(dateStr)) {
        eventDiv.innerHTML = `<span class="w-2 h-2 bg-red-500 rounded-full inline-block mt-1"></span>`;
      }

      // Append day and event indicator to the cell
      cell.appendChild(daySpan);
      cell.appendChild(eventDiv);

      // Add click listener to the day cell for selection/deselection
      cell.addEventListener('click', function(event) {
        // Prevent event from bubbling up to document click handler
        event.stopPropagation();

        // If another cell was previously selected, remove its "selected" class
        const previouslySelected = document.querySelector('.calendar-day.selected');
        if (previouslySelected && previouslySelected !== cell) {
          previouslySelected.classList.remove('selected');
        }

        // Toggle selection on the clicked cell
        if (cell.classList.contains('selected')) {
          // Deselect if already selected
          cell.classList.remove('selected');
          selectedDate = null;
          // Show all events for the month
          generateEventsList(month, year);
        } else {
          cell.classList.add('selected');
          selectedDate = dateStr;
          // Show events for this specific day
          generateEventsListForDay(selectedDate);
        }
      });

      calendarGrid.appendChild(cell);
    }

    // Generate the events list for the month (default view)
    generateEventsList(month, year);
  }

  // Generate a list of all events happening in the given month and year
  function generateEventsList(month, year) {
    eventsDisplayDiv.innerHTML = ''; // Clear previous events
  
    // Filter events for this month and year
    const eventsForMonth = Object.keys(eventData).filter(dateStr => {
      const [eventYear, eventMonth] = dateStr.split('-');
      return parseInt(eventYear) === year && parseInt(eventMonth) === month;
    });
  
    if (eventsForMonth.length === 0) {
      eventsDisplayDiv.innerHTML = '<p class="text-gray-500">No events this month</p>';
    } else {
      const list = document.createElement('ul');
      list.classList.add('list-disc', 'pl-5');
      eventsForMonth.forEach(dateStr => {
        const li = document.createElement('li');
        // Map each event title to a clickable anchor and join them with commas.
        const clickableEvents = eventData[dateStr]
        .map(ev => `<a href="#" class="event-link" data-date="${dateStr}" data-id="${ev.id}" data-title="${ev.title}">${ev.title}</a>`)
        .join(', ');


        li.innerHTML = `<span class="font-semibold">${dateStr}</span>: ${clickableEvents}`;
        list.appendChild(li);
      });
      eventsDisplayDiv.appendChild(list);
    }
  }
  

  // Generate events list for a specific day
  function generateEventsListForDay(dateStr) {
    eventsDisplayDiv.innerHTML = ''; // Clear previous events
    if (eventData.hasOwnProperty(dateStr)) {
      // Build an unordered list of events
      let output = '<ul class="list-disc pl-5">';
      eventData[dateStr].forEach(ev => {
        // Wrap each event in an anchor tag with a data-date and data-title attribute
        output += `<li><a href="#" class="event-link" data-date="${dateStr}" data-id="${ev.id}" data-title="${ev.title}">${ev.title}</a></li>`;
      });
      output += '</ul>';
      eventsDisplayDiv.innerHTML = output;
    } else {
      eventsDisplayDiv.innerHTML = `<p class="text-gray-500">No events on this day</p>`;
    }
  }
  
  function refreshEventsAndCalendar() {
    fetch('../../controllers/eventController.php', {
      method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
      window.events = data; 
      loadPage('calendar');
    })
    .catch(error => {
      console.error("Error refreshing events:", error);
    });
  }
  

  // Listen for clicks outside of a day cell to clear the selection
  document.addEventListener('click', function(event) {
    // If the click target isn't inside a day cell, clear any selection
    if (!event.target.closest('.calendar-day')) {
      const selectedCell = document.querySelector('.calendar-day.selected');
      if (selectedCell) {
        selectedCell.classList.remove('selected');
      }
      selectedDate = null;
      generateEventsList(currentMonth, currentYear);
    }
  });

  // Event listener for the previous month button
  prevBtn.addEventListener('click', function() {
    currentMonth--;
    if (currentMonth < 1) {
      currentMonth = 12;
      currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
  });

  // Event listener for the next month button
  nextBtn.addEventListener('click', function() {
    currentMonth++;
    if (currentMonth > 12) {
      currentMonth = 1;
      currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
  });

  // Plus Button: Toggle the event creation form and hide events display when form appears
  const addEventBtn = document.getElementById('add-event-btn');
  const eventForm = document.getElementById('event-form');
  addEventBtn.addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent the click from triggering other handlers
    eventForm.classList.toggle('hidden'); // Toggle the form visibility
    
    if (!eventForm.classList.contains('hidden')) {
      eventsTitle.textContent = 'Add Event';
    } else {
        eventsTitle.textContent = 'Events';
    }
  
    // If the form is now visible, hide the events display; otherwise, show it.
    if (!eventForm.classList.contains('hidden')) {
      eventsDisplayDiv.classList.add('hidden');
    } else {
      eventsDisplayDiv.classList.remove('hidden');
    }
  });
  
  // Optionally, hide the event form (and show events display) if the user clicks outside of it
  document.addEventListener('click', function(e) {
    if (!e.target.closest('#event-form') && !e.target.closest('#add-event-btn')) {
      eventForm.classList.add('hidden');
      eventsDisplayDiv.classList.remove('hidden');
    }
  });

  // Ensure this is added after the calendar is loaded and eventData is available
  document.getElementById('events-display').addEventListener('click', function(e) {
    if (e.target && e.target.matches('.event-link')) {
      e.preventDefault();
      // Get the event date and title from data attributes
      const eventDate = e.target.getAttribute('data-date');
      const eventTitle = e.target.getAttribute('data-title');
      const eventId = e.target.getAttribute('data-id');
      
      // Prepare form data for details request
      const formData = new FormData();
      formData.append('event_date', eventDate);
      formData.append('event_title', eventTitle);
      
      // Request event details
      fetch('../../controllers/getEventDetails.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log("Response from getEventDetails:", data);
        if (data.status === 'success') {
          const details = data.data;
          // Update events-display with the event title, description, and a delete button
          document.getElementById('events-display').innerHTML = `
            <h3 class="font-bold text-xl mb-2">${details.title}</h3>
            <p>${details.description}</p>
            <button id="delete-event-btn" class="mt-4 p-2 bg-red-500 text-white rounded">Delete Event</button>
          `;
          
          // Attach click listener to the delete button
          document.getElementById('delete-event-btn').addEventListener('click', function(ev) {
            ev.preventDefault();
            if (confirm("Are you sure you want to delete this event?")) {
              const delFormData = new FormData();
              delFormData.append('action', 'delete');
              delFormData.append('event_date', eventDate);
              delFormData.append('event_title', eventTitle);
              delFormData.append('event_id', eventId);
              
              fetch('../../controllers/eventController.php', {
                method: 'POST',
                body: delFormData
              })
              .then(response => response.json())
              .then(delData => {
                if (delData.status === 'success') {
                  alert('Event deleted successfully.');
                  // Reload the calendar (or the events list)
                  refreshEventsAndCalendar()
                } else {
                  alert('Error: ' + delData.message);
                }
              })
              .catch(error => {
                console.error('Error deleting event:', error);
              });
            }
          });
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error fetching event details:', error);
      });
    }
  });


  // Generate the initial calendar when the page loads
  generateCalendar(currentMonth, currentYear);
}
