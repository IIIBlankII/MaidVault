// calendar.js
function initializeCalendar() {
    // Your calendar initialization code goes here
    // For example:
    const events = {
        '2025-02-10': 'Client Meeting',
        '2025-02-15': 'Maid Training Session',
        '2025-02-20': 'Monthly Report Submission'
      };
    
      // Initialize current month and year (months are 1-indexed in this script)
      let currentDate = new Date();
      let currentMonth = currentDate.getMonth() + 1;
      let currentYear = currentDate.getFullYear();
      let selectedDate = null; // To keep track of a selected day (format YYYY-MM-DD)
    
      // DOM elements - these should exist in your HTML
      const calendarTitle = document.getElementById('calendar-title');
      const calendarGrid = document.getElementById('calendar-grid');
      const eventsListDiv = document.getElementById('events-list');
      const prevBtn = document.getElementById('prev');
      const nextBtn = document.getElementById('next');
    
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
          if (events.hasOwnProperty(dateStr)) {
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
        eventsListDiv.innerHTML = '<h3 class="text-lg font-semibold mb-2">Events</h3>';
    
        // Filter events for this month and year
        const eventsForMonth = Object.keys(events).filter(dateStr => {
          const [eventYear, eventMonth] = dateStr.split('-');
          return parseInt(eventYear) === year && parseInt(eventMonth) === month;
        });
    
        if (eventsForMonth.length === 0) {
          eventsListDiv.innerHTML += '<p class="text-gray-500">No events this month</p>';
        } else {
          const list = document.createElement('ul');
          list.classList.add('list-disc', 'pl-5');
          eventsForMonth.forEach(dateStr => {
            const li = document.createElement('li');
            li.innerHTML = `<span class="font-semibold">${dateStr}</span>: ${events[dateStr]}`;
            list.appendChild(li);
          });
          eventsListDiv.appendChild(list);
        }
      }
    
      // Generate events list for a specific day
      function generateEventsListForDay(dateStr) {
        eventsListDiv.innerHTML = '<h3 class="text-lg font-semibold mb-2">Events</h3>';
        if (events.hasOwnProperty(dateStr)) {
          eventsListDiv.innerHTML += `<p><span class="font-semibold">${dateStr}</span>: ${events[dateStr]}</p>`;
        } else {
          eventsListDiv.innerHTML += `<p class="text-gray-500">No events on this day</p>`;
        }
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
    
      // Generate the initial calendar when the page loads
      generateCalendar(currentMonth, currentYear);

  }
  