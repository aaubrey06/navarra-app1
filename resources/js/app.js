import './bootstrap';

// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    // Fetch the user ID from the meta tag
    const userId = document.querySelector('meta[name="user-id"]')?.getAttribute('content');

    if (userId) {
        // Listen for new notifications for the current user
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                // Update notification count if the count element exists
                let countElement = document.getElementById('notificationCount');
                if (countElement) {
                    let count = parseInt(countElement.innerText) || 0;
                    countElement.innerText = count + 1;
                }

                // Append the new notification to the list with better structure
                let notificationList = document.getElementById('notificationList');
                if (notificationList) {
                    let newNotification = document.createElement('li');
                    newNotification.classList.add('notification-item');
                    
                    // Create notification content, assuming notification has 'message' and 'timestamp'
                    newNotification.innerHTML = `
                        <div class="notification-message">${notification.message}</div>
                        <small class="notification-time">${new Date(notification.timestamp).toLocaleTimeString()}</small>
                    `;
                    notificationList.prepend(newNotification);  // Add latest notification at the top
                }
            });

        // Toggle notification dropdown when the button is clicked
        const notificationButton = document.getElementById('notificationButton');
        const dropdown = document.getElementById('notificationDropdown');
        
        notificationButton?.addEventListener('click', function () {
            dropdown?.classList.toggle('show');  // Add 'show' class to handle visibility with CSS
        });

        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!notificationButton?.contains(event.target) && !dropdown?.contains(event.target)) {
                dropdown?.classList.remove('show');
            }
        });
    }
});
