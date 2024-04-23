import './bootstrap';
import './sweetAlert2';

// Get the textarea element
const textarea = document.getElementById('descriptionTextarea');

// Set the height of the textarea based on its scroll height
function adjustTextareaHeight() {
    textarea.style.height = 'auto'; // Reset height to auto to prevent scrollbars
    textarea.style.height = textarea.scrollHeight + 'px'; // Set the height to the scroll height
}

// Call adjustTextareaHeight initially and whenever the textarea content changes
textarea.addEventListener('input', adjustTextareaHeight);

// Call adjustTextareaHeight initially to set the correct height on page load
adjustTextareaHeight();
