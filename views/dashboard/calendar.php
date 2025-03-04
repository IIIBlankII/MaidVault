<div id="calendar-page" class="p-6">
  <h2 class="text-2xl font-semibold mb-4">Calendar & Schedule</h2>
  <div class="bg-white p-4 shadow-md rounded-lg">
    <!-- Calendar header -->
    <div class="flex justify-between items-center">
      <button id="prev" class="p-2">‹</button>
      <h3 id="calendar-title" class="text-lg font-semibold"></h3>
      <button id="next" class="p-2">›</button>
    </div>
    <!-- Weekday headers -->
    <div class="grid grid-cols-7 gap-1 text-center mt-4">
      <div class="font-bold">Mon</div>
      <div class="font-bold">Tue</div>
      <div class="font-bold">Wed</div>
      <div class="font-bold">Thu</div>
      <div class="font-bold">Fri</div>
      <div class="font-bold">Sat</div>
      <div class="font-bold">Sun</div>
    </div>
    <!-- Calendar grid -->
    <div id="calendar-grid" class="grid grid-cols-7 gap-1 text-center mt-2"></div>
  </div>
  
  <!-- Events list container -->
  <div id="events-list" class="mt-6 bg-white p-4 shadow-md rounded-lg"></div>
</div>




