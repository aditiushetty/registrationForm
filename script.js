$(document).ready(function () {
    $("#registrationForm").on("submit", function (event) {
        const phone = $("#phone").val().trim();

        if (!/^[0-9]{10}$/.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            event.preventDefault();
            return;
        }

        if (!this.checkValidity()) {
            event.preventDefault();
            this.reportValidity();
            return;
        }
    });

    // Allow digits only in the phone number field.
    $("#phone").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "").slice(0, 10);
    });
});
