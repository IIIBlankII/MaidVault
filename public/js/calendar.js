
function initializeCalendar() {

// Initialize calendar variables
let currentDate = new Date('2025-03-01');
let currentMonth = currentDate.getMonth() + 1;
let currentYear = currentDate.getFullYear();
let selectedDate = null;

const calendarTitle = document.getElementById('calendar-title');
const calendarGrid = document.getElementById('calendar-grid');
const eventsDisplayDiv = document.getElementById('events-display');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const eventsTitle = document.getElementById('events-title');
const addEventBtn = document.getElementById('add-event-btn');
const eventForm = document.getElementById('event-form');


const eventData = window.events || {};

// Function to generate the calendar grid for a given month and year
function generateCalendar(month, year) {
  selectedDate = null;
  const dateObj = new Date(year, month - 1);
  const monthName = dateObj.toLocaleString('default', { month: 'long' });
  calendarTitle.textContent = `${monthName} ${year}`;
  calendarGrid.innerHTML = '';

  const firstDay = new Date(year, month - 1, 1);
  let startDay = firstDay.getDay();
  startDay = startDay === 0 ? 7 : startDay; 

  // Fill in empty cells before the first day
  for (let i = 1; i < startDay; i++) {
    const emptyCell = document.createElement('div');
    calendarGrid.appendChild(emptyCell);
  }

  const daysInMonth = new Date(year, month, 0).getDate();
  for (let day = 1; day <= daysInMonth; day++) {
    const cell = document.createElement('div');
    cell.classList.add('calendar-day');
    const daySpan = document.createElement('span');
    daySpan.classList.add('font-semibold');
    daySpan.textContent = day;
    const dayStr = day.toString().padStart(2, '0');
    const monthStr = month.toString().padStart(2, '0');
    const dateStr = `${year}-${monthStr}-${dayStr}`;

    const eventDiv = document.createElement('div');
    eventDiv.classList.add('text-xs');
    if (eventData.hasOwnProperty(dateStr)) {
      eventDiv.innerHTML = `<span class="w-2 h-2 bg-red-500 rounded-full inline-block mt-1"></span>`;
    }

    cell.appendChild(daySpan);
    cell.appendChild(eventDiv);

    // Click handler for selecting/deselecting a day
    cell.addEventListener('click', function(e) {
      e.stopPropagation();
      const previouslySelected = document.querySelector('.calendar-day.selected');
      if (previouslySelected && previouslySelected !== cell) {
        previouslySelected.classList.remove('selected');
      }
      if (cell.classList.contains('selected')) {
        cell.classList.remove('selected');
        selectedDate = null;
        generateEventsList(month, year);
      } else {
        cell.classList.add('selected');
        selectedDate = dateStr;
        generateEventsListForDay(selectedDate);
      }
    });

    calendarGrid.appendChild(cell);
  }
  generateEventsList(month, year);
}

// Function to generate events list for the entire month
function generateEventsList(month, year) {
  eventsDisplayDiv.innerHTML = '';
  const eventsForMonth = Object.keys(eventData).filter(dateStr => {
    const [eventYear, eventMonth] = dateStr.split('-');
    return parseInt(eventYear) === year && parseInt(eventMonth) === month;
  });
  if (eventsForMonth.length === 0) {
    eventsDisplayDiv.innerHTML = '<p class="text-gray-400">No events this month</p>';
  } else {
    const list = document.createElement('ul');
    list.classList.add('list-disc', 'pl-5');
    eventsForMonth.forEach(dateStr => {
      const li = document.createElement('li');
      const clickableEvents = eventData[dateStr]
        .map(ev => `<a href="#" class="event-link" data-date="${dateStr}" data-id="${ev.id}" data-title="${ev.title}">${ev.title}</a>`)
        .join(', ');
      li.innerHTML = `<span class="font-semibold">${dateStr}</span>: ${clickableEvents}`;
      list.appendChild(li);
    });
    eventsDisplayDiv.appendChild(list);
  }
}

// Function to generate events list for a specific day
function generateEventsListForDay(dateStr) {
  eventsDisplayDiv.innerHTML = '';
  if (eventData.hasOwnProperty(dateStr)) {
    let output = '<ul class="list-disc pl-5">';
    eventData[dateStr].forEach(ev => {
      output += `<li><a href="#" class="event-link" data-date="${dateStr}" data-id="${ev.id}" data-title="${ev.title}">${ev.title}</a></li>`;
    });
    output += '</ul>';
    eventsDisplayDiv.innerHTML = output;
  } else {
    eventsDisplayDiv.innerHTML = `<p class="text-gray-400">No events on this day</p>`;
  }
}

// Function to refresh events and reload the calendar
function refreshEventsAndCalendar() {
  fetch('../../controllers/eventController.php', { method: 'POST' })
    .then(response => response.json())
    .then(data => {
      window.events = data;
      loadPage('calendar');
    })
    .catch(error => console.error("Error refreshing events:", error));
}

// Clear selection if clicking outside any calendar-day
document.addEventListener('click', function(e) {
  if (!e.target.closest('.calendar-day')) {
    const selectedCell = document.querySelector('.calendar-day.selected');
    if (selectedCell) { selectedCell.classList.remove('selected'); }
    selectedDate = null;
    generateEventsList(currentMonth, currentYear);
  }
});

// Month navigation event listeners
prevBtn.addEventListener('click', function() {
  currentMonth--;
  if (currentMonth < 1) { currentMonth = 12; currentYear--; }
  generateCalendar(currentMonth, currentYear);
});

nextBtn.addEventListener('click', function() {
  currentMonth++;
  if (currentMonth > 12) { currentMonth = 1; currentYear++; }
  generateCalendar(currentMonth, currentYear);
});

// Toggle event creation form visibility
addEventBtn.addEventListener('click', function(e) {
  e.stopPropagation();
  eventForm.classList.toggle('hidden');
  eventsTitle.textContent = eventForm.classList.contains('hidden') ? 'Events' : 'Add Event';
  if (!eventForm.classList.contains('hidden')) {
    eventsDisplayDiv.classList.add('hidden');
  } else {
    eventsDisplayDiv.classList.remove('hidden');
  }
});

// Hide event form if clicking outside of it
document.addEventListener('click', function(e) {
  if (!e.target.closest('#event-form') && !e.target.closest('#add-event-btn')) {
    eventForm.classList.add('hidden');
    eventsDisplayDiv.classList.remove('hidden');
  }
});

// Handle event link clicks to fetch event details and show delete button
document.getElementById('events-display').addEventListener('click', function(e) {
  if (e.target && e.target.matches('.event-link')) {
    e.preventDefault();
    const eventDate = e.target.getAttribute('data-date');
    const eventTitle = e.target.getAttribute('data-title');
    const eventId = e.target.getAttribute('data-id');
    const formData = new FormData();
    formData.append('event_date', eventDate);
    formData.append('event_title', eventTitle);
    fetch('../../controllers/getEventDetails.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        const details = data.data;
        document.getElementById('events-display').innerHTML = `
          <h3 class="font-bold text-xl mb-2">${details.title}</h3>
          <p>${details.description}</p>
          <button id="delete-event-btn" class="mt-4 p-2 bg-red-500 text-white rounded">Delete Event</button>
        `;
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
                refreshEventsAndCalendar();
              } else {
                alert('Error: ' + delData.message);
              }
            })
            .catch(error => console.error('Error deleting event:', error));
          }
        });
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => console.error('Error fetching event details:', error));
  }
});

// Generate the initial calendar on page load
generateCalendar(currentMonth, currentYear);
};