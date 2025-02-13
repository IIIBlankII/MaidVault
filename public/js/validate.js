function validateForm() {
    let firstName = document.getElementById("first-name").value.trim();
    let lastName = document.getElementById("last-name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let emailPattern = /^[^\s@]+@[^\s@]+\.com$/;
    let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (firstName === "" || lastName === "" || email === "" || password === "") {
        alert("All fields are required.");
        return false;
    }

    if (!emailPattern.test(email)) {
        alert("Invalid email format. Email must end with .com");
        return false;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long and include at least one letter, one number, and one special character.");
        return false;
    }

    return true;
}
