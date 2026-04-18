// Get CSRF token
function getCSRF() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

// ================= LOGIN =================
window.login = function () {

    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
    })
        .then(res => res.json())
        .then(data => {

            if (!data.token) {
                alert(data.message || 'Invalid credentials');
                return;
            }

            // Store token in browser
            localStorage.setItem('token', data.token);

            // Store token in Laravel session
            fetch('/set-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRF()
                },
                body: JSON.stringify({ token: data.token })
            })
                .then(() => {
                    window.location.href = '/dashboard';
                });
        })
        .catch(() => {
            alert('Login failed');
        });
};


// ================= REGISTER =================
window.register = function () {

    fetch('/api/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
    })
        .then(res => res.json())
        .then(data => {

            if (!data.token) {
                alert(data.message || 'Registration failed');
                return;
            }

            // Store token
            localStorage.setItem('token', data.token);

            // Store in session
            fetch('/set-session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRF()
                },
                body: JSON.stringify({ token: data.token })
            })
                .then(() => {
                    window.location.href = '/dashboard';
                });
        })
        .catch(() => {
            alert('Registration error');
        });
};


// ================= LOGOUT =================
window.logout = function () {

    localStorage.removeItem('token');

    fetch('/logout', {
        method: 'GET'
    }).then(() => {
        window.location.href = '/login';
    });
};