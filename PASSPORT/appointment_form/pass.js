var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

$(function() {
  var businessHours = {
      'default': [
          ['09:00', '13:00'],
          ['14:00', '18:00']
      ]
  };
  var appointments = {
      '2023-06-29': [
          ['10:00', '10:30'],
          ['15:30', '16:15']
      ]
  };

  function getAvailableSlots(date) {
      var slots = [];
      var dayKey = $.datepicker.formatDate('yy-mm-dd', date);
      var dayOfWeek = date.getDay();

      if (dayOfWeek === 6 || dayOfWeek === 0) {
          // No slots available on Saturdays (6) and Sundays (0)
          return slots;
      }

      var businessHour = businessHours['default'];
      businessHour.forEach(function(hour) {
          var start = new Date(dayKey + 'T' + hour[0] + ':00');
          var end = new Date(dayKey + 'T' + hour[1] + ':00');
          while (start < end) {
              var first = new Date(start);
              start.setMinutes(start.getMinutes() + 15);
              slots.push([formatTime(first), formatTime(start)]);
          }
      });

      if (appointments[dayKey]) {
          appointments[dayKey].forEach(function(appointment) {
              slots = slots.filter(function(slot) {
                  return !(slot[0] >= appointment[0] && slot[1] <= appointment[1]);
              });
          });
      }

      return slots;
  }

  function formatTime(date) {
      var hours = date.getHours().toString().padStart(2, '0');
      var minutes = date.getMinutes().toString().padStart(2, '0');
      return hours + ':' + minutes;
  }

  function updateAvailableSlots(date) {
      var availableSlots = getAvailableSlots(date);
      var slotsContainer = $('#available-slots');
      var selectedTimeContainer = $('#selected-time');
      var datepickerContainer = $('#datepicker-container');
      
      slotsContainer.empty();
      selectedTimeContainer.text('');
      slotsContainer.show();  // Show the slots container when updating slots
      datepickerContainer.show();  // Show the datepicker container when updating slots
      
      availableSlots.forEach(function(slot) {
          var slotElement = $('<div class="time-slot available">' + slot[0] + ' - ' + slot[1] + '</div>');
          slotElement.click(function() {
              selectedTimeContainer.html('<form><label for="selected-date">Selected Date:</label><input type="text" id="selected-date" name="selected-date" value="' + $.datepicker.formatDate('yy-mm-dd', date) + '" readonly><br><label for="selected-time">Selected Time:</label><input type="text" id="selected-time" name="selected-time" value="' + slot[0] + ' - ' + slot[1] + '" readonly></form>');
              slotsContainer.hide();  // Hide the slots container after a slot is selected
              datepickerContainer.hide();  // Hide the datepicker container after a slot is selected
          });
          slotsContainer.append(slotElement);
      });
  }

  $("#datepicker").datepicker({
      beforeShowDay: function(date) {
          var day = date.getDay();
          if (day === 0 || day === 6) {
              return [false, 'unavailable-day', 'Unavailable'];
          } else {
              return [true, '', ''];
          }
      },
      onSelect: function(dateText, inst) {
          var date = $(this).datepicker('getDate');
          updateAvailableSlots(date);
      }
  });
});
