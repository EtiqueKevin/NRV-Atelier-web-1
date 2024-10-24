export function showAlert(message, type) {
    const alertDiv = document.getElementById('alert-message');
    alertDiv.innerHTML = message;
    
    alertDiv.classList.remove('alert-ok', 'alert-error', 'alert-warning');
    
    if (type === 'ok') {
      alertDiv.classList.add('alert-ok');
    } else if (type === 'error') {
      alertDiv.classList.add('alert-error');
    } else if (type === 'warning') {
      alertDiv.classList.add('alert-warning');
    }
    
    alertDiv.style.display = 'block';
    
    setTimeout(() => {
      alertDiv.style.display = 'none';
    }, 5000);
  }