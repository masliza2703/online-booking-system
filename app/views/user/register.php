<?php if (!empty($error)): ?>
    <div style="background:#ffe0e0;color:#b94a48;padding:0.8rem 1rem;border-radius:8px;margin:1rem 0;text-align:center;font-weight:bold;">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>
<?php if (isset($_GET['registered'])): ?>
    <div style="background:#e0ffe0;color:#2e7d32;padding:0.8rem 1rem;border-radius:8px;margin:1rem 0;text-align:center;font-weight:bold;">
        Registration successful! Please login.
    </div>
<?php endif; ?>
<div style="max-width:400px;margin:2.5rem auto;padding:0;background:#fff;border-radius:2rem;box-shadow:0 2px 12px rgba(0,0,0,0.07);overflow:hidden;">
    <div style="width:100%;text-align:center;margin-bottom:2.5rem;">
  <div style="
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 1.3rem;
    font-weight: bold;
    color: #fff;
    background: #8d624a;
    border-radius: 12px;
    padding: 18px 0 8px 0;
    letter-spacing: 1.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin: 0 auto 1rem auto;
    width: 90%;
    ">
    Spa Makcik Urut <br>
    <span style="font-size:1.05rem;font-weight:normal;letter-spacing:2px;color:#ffd9b3;">Muslimah</span>
  </div>
</div>
    <form method="post" style="padding:2rem;" id="registerForm">
        <div style="margin-bottom:1.2rem;">
            <label style="font-weight:bold;">Full Name</label>
            <input type="text" name="fullname" placeholder="Enter your full name" style="width:100%;padding:0.9rem 1rem;border-radius:0.7rem;border:1.5px solid #eee;font-size:1.1rem;margin-top:0.3rem;">
        </div>
        <div style="margin-bottom:1.2rem;">
            <label style="font-weight:bold;">Staff Email</label>
            <input type="email" name="email" placeholder="Enter your staff email" style="width:100%;padding:0.9rem 1rem;border-radius:0.7rem;border:1.5px solid #eee;font-size:1.1rem;margin-top:0.3rem;">
        </div>
        <div style="margin-bottom:1.2rem;">
            <label style="font-weight:bold;">Phone Number</label>
            <input type="tel" name="phone" placeholder="Enter your phone number" style="width:100%;padding:0.9rem 1rem;border-radius:0.7rem;border:1.5px solid #eee;font-size:1.1rem;margin-top:0.3rem;">
        </div>
        <div style="margin-bottom:1.2rem;">
            <label style="font-weight:bold;">Password</label>
            <div style="display:flex;align-items:center;position:relative;">
                <input type="password" name="password" id="password" placeholder="Enter your password" style="width:100%;padding:0.9rem 2.5rem 0.9rem 1rem;border-radius:0.7rem;border:1.5px solid #eee;font-size:1.1rem;margin-top:0.3rem;" onkeyup="checkPasswordStrength()">
                <span onclick="togglePassword()" style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);cursor:pointer;font-size:1.2rem;color:#888;">&#128065;</span>
            </div>
            <div id="password-requirements" style="margin-top:0.5rem;font-size:0.9rem;color:#666;">
                <div style="margin-bottom:0.3rem;"><strong>Password must contain:</strong></div>
                <div id="length-check" style="color:#ff6b6b;">• At least 8 characters</div>
                <div id="uppercase-check" style="color:#ff6b6b;">• At least 1 uppercase letter</div>
                <div id="lowercase-check" style="color:#ff6b6b;">• At least 1 lowercase letter</div>
                <div id="number-check" style="color:#ff6b6b;">• At least 1 number</div>
                <div id="special-check" style="color:#ff6b6b;">• At least 1 special character (!@#$%^&*)</div>
            </div>
            <div id="password-strength" style="margin-top:0.5rem;height:4px;background:#eee;border-radius:2px;overflow:hidden;">
                <div id="strength-bar" style="height:100%;width:0%;transition:all 0.3s;background:#ff6b6b;"></div>
            </div>
        </div>
        <button type="submit" style="background:#9c6b53;color:#fff;padding:1rem 0;border-radius:0.8rem;font-size:1.1rem;font-weight:bold;width:100%;margin-top:0.5rem;display:flex;align-items:center;justify-content:center;gap:0.7rem;" id="submitBtn" disabled>
            <span style="font-size:1.2rem;">&#128100;</span> Register
        </button>
        <div style="text-align:center;margin-top:1.5rem;">
            <a href="/public/index.php?page=login" style="color:#9c6b53;text-decoration:none;font-size:1rem;display:inline-block;">
                <span style="font-size:1.1rem;vertical-align:middle;">&#128274;</span> Already have an account? Login here
            </a>
        </div>
    </form>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = event.target;
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '&#128065;&#8205;&#127787;'; // Eye with slash
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '&#128065;'; // Eye
    }
}

function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const submitBtn = document.getElementById('submitBtn');
    const strengthBar = document.getElementById('strength-bar');
    
    // Password requirements
    const hasLength = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecial = /[!@#$%^&*]/.test(password);
    
    // Update requirement indicators
    document.getElementById('length-check').style.color = hasLength ? '#51cf66' : '#ff6b6b';
    document.getElementById('uppercase-check').style.color = hasUppercase ? '#51cf66' : '#ff6b6b';
    document.getElementById('lowercase-check').style.color = hasLowercase ? '#51cf66' : '#ff6b6b';
    document.getElementById('number-check').style.color = hasNumber ? '#51cf66' : '#ff6b6b';
    document.getElementById('special-check').style.color = hasSpecial ? '#51cf66' : '#ff6b6b';
    
    // Calculate strength
    let strength = 0;
    if (hasLength) strength += 20;
    if (hasUppercase) strength += 20;
    if (hasLowercase) strength += 20;
    if (hasNumber) strength += 20;
    if (hasSpecial) strength += 20;
    
    // Update strength bar
    strengthBar.style.width = strength + '%';
    if (strength <= 40) {
        strengthBar.style.background = '#ff6b6b'; // Red
    } else if (strength <= 80) {
        strengthBar.style.background = '#ffd93d'; // Yellow
    } else {
        strengthBar.style.background = '#51cf66'; // Green
    }
    
    // Enable/disable submit button
    const isStrong = hasLength && hasUppercase && hasLowercase && hasNumber && hasSpecial;
    submitBtn.disabled = !isStrong;
    submitBtn.style.background = isStrong ? '#9c6b53' : '#ccc';
    submitBtn.style.cursor = isStrong ? 'pointer' : 'not-allowed';
}

// Form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const hasLength = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasLowercase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecial = /[!@#$%^&*]/.test(password);
    
    if (!(hasLength && hasUppercase && hasLowercase && hasNumber && hasSpecial)) {
        e.preventDefault();
        alert('Please ensure your password meets all strength requirements.');
        return false;
    }
});
</script> 