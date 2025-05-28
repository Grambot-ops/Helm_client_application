import Swal from 'sweetalert2';
window.Swal = Swal;

// toast with default settings and event listener
window.addEventListener('swal:toast', event => {
    // default settings for toasts
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: 'white',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    // convert some attributes
    let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
    config = convertAttributes(config);
    // override default settings or add new settings
    Toast.fire(config);
});

function convertAttributes(attributes) {
    // convert predefined 'words' to a real color
    switch (attributes.background) {
        case 'danger':
        case 'error':
            attributes.background = 'rgb(254, 226, 226)';
            break;
        case 'warning':
            attributes.background = 'rgb(255, 237, 213)';
            break;
        case 'primary':
        case 'info':
            attributes.background = 'rgb(207, 250, 254)';
            break;
        case 'success':
            attributes.background = 'rgb(220, 252, 231)';
            break;
    }
    // if the attribute 'text' is set, convert it to the attribute 'html'
    if (attributes.text) {
        attributes.html = attributes.text;
        delete attributes.text;
    }
    return attributes;
}
