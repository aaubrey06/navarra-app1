import './bootstrap';

// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Fetch the user ID from the meta tag
    const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

    if (userId) {
        // Listen for new notifications for the current user
        window.Echo.private('App.Models.User.' + userId)
            .notification((notification) => {
                // Update notification count
                let countElement = document.getElementById('notificationCount');
                let count = parseInt(countElement.innerText);
                countElement.innerText = count + 1;

                // Append the new notification to the list
                let notificationList = document.getElementById('notificationList');
                let newNotification = document.createElement('li');
                newNotification.innerText = notification.message;  // Assuming notification has a 'message' field
                notificationList.appendChild(newNotification);
            });

        // Toggle notification dropdown when button is clicked
        document.getElementById('notificationButton').addEventListener('click', function() {
            let dropdown = document.getElementById('notificationDropdown');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
            }
        });
    }
});
