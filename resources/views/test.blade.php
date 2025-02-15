<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - NasheedHub</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: blue;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: darkblue;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Create a NasheedHub Account</h2>
        <form id="signupForm">
            <label>Full Name:</label>
            <input type="text" id="name" required>

            <label>Phone:</label>
            <input type="text" id="phone" required>

            <label>Whatsapp:</label>
            <input type="text" id="whatsapp">

            <label>Email:</label>
            <input type="email" id="email" required>

            <label>Password:</label>
            <input type="password" id="password" required>

            <label>Confirm Password:</label>
            <input type="password" id="confirmPassword" required>

            <button type="button" id="sign_up_btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.html">Login</a></p>
        <p id="message"></p>
    </div>

    <script >

document.getElementById("sign_up_btn").addEventListener("click", async function(event) {
    event.preventDefault();

    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let whatsapp = document.getElementById("whatsapp").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let messageBox = document.getElementById("message");

    if (password !== confirmPassword) {
        messageBox.innerText = "Passwords do not match!";
        messageBox.style.color = "red";
        return;
    }

    let data = {
        name: name,
        phone: phone,
        whatsapp: whatsapp,
        email: email,
        password: password,
        password_confirmation: confirmPassword
    };

    // try {
        let response = await fetch("{{url('/')}}/api/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        let result = await response.json();

        console.log(response);

        // if (response.status === 200) {
        //     messageBox.innerText = "Account created successfully!";
        //     messageBox.style.color = "green";
        // } else {
        //     messageBox.innerText = result.message;
        //     messageBox.style.color = "red";
        // } 
        
    //}
});
    </script>
</body>
</html>
