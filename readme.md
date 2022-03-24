# IERG4210 Assignment Phase 4

<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" /> <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" /> <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" /> <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" /> <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />

📚 Name: Lau Long Ching </br>
🗂️ SID: 1155127347

Please visit [http://3.13.126.10](http://3.13.126.10) or [https://secure.s31.ierg4210.ie.cuhk.edu.hk/](https://secure.s31.ierg4210.ie.cuhk.edu.hk/) to mark my assignment, thank you!

## Phase 3 marking checklist
1. No XSS Injection and Parameter Tampering Vulnerabilities in the whole website <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- [UI Enhancement Only] Proper and vigorous client-side input restrictions for all forms <img src="https://img.shields.io/badge/-complete-green" align="right" />

<p align="center">
<img src="./assignment/2.png" align="center" /></br>
</p>

- Proper and vigorous server-side input sanitizations and validations for all forms <img src="https://img.shields.io/badge/-complete-green" align="right" />

<p align="center">
<img src="./assignment/1.png" align="center" /></br>
</p>

- Proper and vigorous context-dependent output sanitizations <img src="https://img.shields.io/badge/-complete-green" align="right" />

<p align="center">
<img src="./assignment/3.png" align="center" /><img src="./assignment/4.png" align="center" /></br>
</p>
 
2. Mitigate SQL Injection Vulnerabilities in the whole website <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- Apply parameterized SQL statements with the PDO library <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/5.png" align="center" /></br>
</p>

3. Mitigate CSRF Vulnerabilities in the whole website <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- Apply and validate secret nonces for every form <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/6.png" align="center" /></br>
</p>

- ALL forms must defend against Traditional and Login CSRF <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/7.png" align="center" /></br>
</p>


4. Authentication for Admin Panel

- Create a user table (or a separate DB with only one user table)  <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - Required columns: userid (primary key), email, password
  - Data:at least 2 users of your choice, 1 admin and 1 normal user (using admin flag)
  - Security: Passwords must be properly salted and hashed before storage

<p align="center">
<img src="./assignment/8.png" align="center" /></br>
</p>

- Build a login page login.php that requests for email and password <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/9.png" align="center" /></br>
</p>

  - Upon validated and authenticated, redirect the user to the admin panel or main page <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - Indicate user name (or “guest” if not logged in) in your website <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/10.png" align="center" /></br>
</p>

  - Otherwise, prompt for errors (i.e. either email or password is incorrect) <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

  <p align="center">
<img src="./assignment/11.png" align="center" /></br>
</p>
  - A separated normal user login page is not compulsory <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- Maintain an authentication token using Cookies (with httpOnly) <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - Cookie name: auth; value: a hashed token; property: httpOnly
  - Cookies persist after browser restart (i.e. 0 < expires < 3 days)
<p align="center">
<img src="./assignment/12.png" align="center" /></br>
</p>

  - No Session Fixation Vulnerabilities (rotate session id upon successful login) <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/14.png" align="center" /></br>
</p>
  - Configure all authentication cookies to use the Secure and HttpOnly flags <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

  <p align="center">
<img src="./assignment/13.png" align="center" /></br>
</p>

- Validate the authentication token before revealing and executing admin features <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - If successful, let admin users access the admin panel and execute admin features
  - Otherwise (e.g. empty or tampered token), redirect back to the login page or main page
  - Security: both admin.html and admin-process.php must validate the auth. token
<p align="center">
<img src="./assignment/15.png" align="center" /><img src="./assignment/16.png" align="center" /></br>
</p>


- PHP & SQL: Provide a logout feature that clears the authentication token <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/17.png" align="center" /></br>
</p>

- Supporting Change of Password <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - Must validate the current password first
  - Logout user after the password is changed

<p align="center">
<img src="./assignment/18.png" align="center" /></br>
</p>

5. All generated session IDs and nonces are not guessable throughout the whole assign. <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- e.g., the login token must not reveal the original password in plaintext <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<p align="center">
<img src="./assignment/19.png" align="center" /></br>
</p>

- e.g., the CSRF nonce when applied in a hidden field must be random <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/20.png" align="center" /></br>
</p>


6. Apply SSL certificate for secure.s[1-80].ierg4210.ie.cuhk.edu.hk <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

- Certificate Application <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - When generating a CSR, use CUHK as Organization Name
  - Apply for a 90-day free certificate at https://www.ssl.com/certificates/free/buy/ or https://letsencrypt.org/ (or others)

  <p align="center">
<img src="./assignment/21.png" align="center" /></br>
</p>


- Certificate Installation <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
  - Install the issued certificate and apply security configurations in Apache
  - Apply strong algorithms and secure cipher suites▪ Host admin panel at https://secure.s[1-80].ierg4210.ie.cuhk.edu.hk/admin.php
  - In the .htaccess  ( other ways are also OK ), redirect users to https website if come from http://[secure...] or http://[...]/admin.php 

  <p align="center">
<img src="./assignment/22.png" align="center" /></br>
</p>