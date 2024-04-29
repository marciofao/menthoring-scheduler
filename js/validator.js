document.getElementById('appointmentForm').addEventListener('submit', function(event) {
     // Get the input date value
     var inputDate = document.getElementById('date').value;
     // Get current date and also fix js date offset issue
     var currentDate = new Date();
     const year = currentDate.getUTCFullYear();
     const month = (currentDate.getUTCMonth() + 1).toString().padStart(2, '0');
     const day = currentDate.getUTCDate()-1
     //formatted yyyy-mm-dd
    currentDate = `${year}-${month}-${day}`;
    
    // Check if the input date is in the past
    if (inputDate < currentDate) {
        alert("Please select a future date.");
        event.preventDefault();
        return;
    }

    // Check if the date is the current day
    if (inputDate === currentDate) {
        
        var inputTime = new Date('1970-01-01T' + document.getElementById('time').value + ':00');
        var currentTime = new Date();
        // Check if the input time is earlier than the current time
        if (inputTime < currentTime) {
            alert("Please select a time later than the current time.");
            event.preventDefault();
            return;
        }
    }

    // Check if the name input contains at least a first and last name
    var fullName = document.getElementById('name').value.trim().split(' ');
    if (fullName.length < 2) {
        alert("Please enter at least a first and last name.");
        event.preventDefault();
    }

    event.preventDefault();
        return; 
});