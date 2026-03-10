<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 pointer-events-none"
     @if(session('success')) data-success="{{ session('success') }}" @endif
     @if(session('error')) data-error="{{ session('error') }}" @endif
     @if($errors->any()) data-errors="{{ json_encode($errors->all()) }}" @endif>
    <!-- Toasts will be inserted here dynamically -->
</div>

<!-- Toast JavaScript -->
<script>
/* eslint-disable */
// @ts-nocheck
function showToast(message, type) {
    type = type || 'success';
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'pointer-events-auto transform transition-all duration-300 translate-x-full opacity-0';
    
    // Set colors based on type
    let bgColor, borderColor, iconColor, icon;
    if (type === 'success') {
        bgColor = 'bg-white';
        borderColor = 'border-green-500';
        iconColor = 'text-green-500';
        icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    } else if (type === 'error') {
        bgColor = 'bg-white';
        borderColor = 'border-red-500';
        iconColor = 'text-red-500';
        icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    } else if (type === 'info') {
        bgColor = 'bg-white';
        borderColor = 'border-blue-500';
        iconColor = 'text-blue-500';
        icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
    } else {
        bgColor = 'bg-white';
        borderColor = 'border-yellow-500';
        iconColor = 'text-yellow-500';
        icon = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
    }
    
    toast.innerHTML = '<div class="' + bgColor + ' rounded-xl shadow-2xl border-l-4 ' + borderColor + ' p-4 min-w-[320px] max-w-md">' +
        '<div class="flex items-start gap-3">' +
            '<div class="' + iconColor + ' flex-shrink-0">' + icon + '</div>' +
            '<div class="flex-1"><p class="text-gray-900 font-medium text-sm leading-relaxed">' + message + '</p></div>' +
            '<button onclick="this.closest(\'.transform\').remove()" class="text-gray-400 hover:text-gray-600 transition flex-shrink-0">' +
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>' +
                '</svg>' +
            '</button>' +
        '</div>' +
    '</div>';
    
    container.appendChild(toast);
    
    // Trigger animation
    setTimeout(function() {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 10);
    
    // Auto remove after 5 seconds
    setTimeout(function() {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(function() {
            toast.remove();
        }, 300);
    }, 5000);
}

// Show toasts on page load
document.addEventListener('DOMContentLoaded', function() {
    var container = document.getElementById('toast-container');
    if (!container) return;
    
    var successMsg = container.getAttribute('data-success');
    var errorMsg = container.getAttribute('data-error');
    var errorsJson = container.getAttribute('data-errors');
    
    if (successMsg) {
        showToast(successMsg, 'success');
    }
    
    if (errorMsg) {
        showToast(errorMsg, 'error');
    }
    
    if (errorsJson) {
        try {
            var errors = JSON.parse(errorsJson);
            if (errors && errors.length > 0) {
                errors.forEach(function(error) {
                    showToast(error, 'error');
                });
            }
        } catch (e) {
            console.error('Error parsing toast errors:', e);
        }
    }
});
</script>
