document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start_date').value = today;

    const clientSelect = document.getElementById('gym_client_id');
    const newClientFields = document.getElementById('new-client-fields');
    const inputs = newClientFields.querySelectorAll('input');

    clientSelect.addEventListener('change', function () {
        if (this.value !== "") {
            newClientFields.style.opacity = "0.5";
            inputs.forEach(i => i.disabled = true);
        } else {
            newClientFields.style.opacity = "1";
            inputs.forEach(i => i.disabled = false);
        }
    });
});