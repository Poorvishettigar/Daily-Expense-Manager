// Form containers
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

// Submit buttons
const signInSubmit = document.getElementById('signInSubmit');
const signUpSubmit = document.getElementById('signUpSubmit');

// Switch between Sign In and Sign Up forms
signUpButton.addEventListener('click', () => {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});

signInButton.addEventListener('click', () => {
    signUpForm.style.display = "none";
    signInForm.style.display = "block";
});

// Sign In form submission
signInSubmit.addEventListener('click', () => {
    const email = document.getElementById('signInEmail').value.trim();
    const password = document.getElementById('signInPassword').value.trim();

    // Example validation: replace this with real server validation logic
    if (email === 'test@example.com' && password === '123456') {
        alert('Sign In successful!');
        window.location.href = 'eindex.html'; // Replace with your actual URL
    } else {
        alert('Invalid credentials. Please provide correct values.');
    }
});

// Sign Up form submission
signUpSubmit.addEventListener('click', () => {
    const fName = document.getElementById('fName').value.trim();
    const lName = document.getElementById('lName').value.trim();
    const email = document.getElementById('signUpEmail').value.trim();
    const password = document.getElementById('signUpPassword').value.trim();

    if (!fName || !lName || !email || !password) {
        alert('All fields are required. Please fill in all details.');
    } else {
        alert('Sign Up successful!');
        window.location.href = 'eindex.html'; // Replace with your actual URL
    }
});
