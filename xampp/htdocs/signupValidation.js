//Had this in here just incase I need to have javascript in the future

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm"); // Adjust this ID to match your form ID
    const errorMsg = document.getElementById("errorMsg"); // ID of the element where error messages will be displayed

    form.addEventListener("submit", function (event) {
        // Prevent form submission initially
        event.preventDefault();

        // Clear previous error messages
        errorMsg.textContent = '';
        
        // Get form values
        const firstName = form.firstname.value.trim();
        const lastName = form.lastname.value.trim();
        const email = form.email.value.trim();
        const userName = form.username.value.trim();
        const password = form.password.value.trim();
        const confirm = form.confirm.value.trim();
        const phone = form.phone.value.trim();
        const address = form.address.value.trim();
        const province = form.province.value;
        const postalCode = form.postalCode.value.trim();
        const url = form.url.value.trim();
        const desc = form.desc.value.trim();
        const location = form.location.value.trim();

        // Validate fields
        let isValid = true;

        if (firstName === "" || firstName.length > 50) {
            errorMsg.textContent += "First name is required and can't be larger than 50 characters.\n";
            isValid = false;
        }
        if (lastName === "" || lastName.length > 50) {
            errorMsg.textContent += "Last name is required and can't be larger than 50 characters.\n";
            isValid = false;
        }
        if (userName === "" || userName.length > 50) {
            errorMsg.textContent += "Screen name is required and can't be larger than 50 characters.\n";
            isValid = false;
        }
        if (email === "" || email.length > 100) {
            errorMsg.textContent += "Email is required and can't be larger than 100 characters.\n";
            isValid = false;
        }
        if (password === "" || password.length > 250) {
            errorMsg.textContent += "Password is required and can't be larger than 250 characters.\n";
            isValid = false;
        }
        if (confirm !== password) {
            errorMsg.textContent += "Passwords must match.\n";
            isValid = false;
        }
        if (phone === "" || !/^(\(\d{3}\) |\d{3} )\d{3}-\d{4}$/.test(phone) || phone.length > 25) {
            errorMsg.textContent += "Phone is required and must be in the format (123) 456-7890.\n";
            isValid = false;
        }
        if (address === "" || address.length > 200) {
            errorMsg.textContent += "Address is required and can't be larger than 200 characters.\n";
            isValid = false;
        }
        if (province === "") {
            errorMsg.textContent += "Province is required.\n";
            isValid = false;
        }
        if (postalCode === "" || !/^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i.test(postalCode) || postalCode.length > 7) {
            errorMsg.textContent += "Postal code is required and must be valid.\n";
            isValid = false;
        }
        if (desc === "" || desc.length > 160) {
            errorMsg.textContent += "Description is required and can't be larger than 160 characters.\n";
            isValid = false;
        }
        if (location.length > 50) {
            errorMsg.textContent += "Location can't be larger than 50 characters.\n";
            isValid = false;
        }

        // If valid, submit the form
        if (isValid) {
            form.submit(); // This will submit the form to the server
        }
    });
});
