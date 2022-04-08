# IERG4210 Assignment Phase 5

<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" /> <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" /> <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" /> <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" /> <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />

📚 Name: Lau Long Ching </br>
🗂️ SID: 1155127347

Please visit [http://3.13.126.10](http://3.13.126.10) or [https://secure.s31.ierg4210.ie.cuhk.edu.hk/](https://secure.s31.ierg4210.ie.cuhk.edu.hk/) to mark my assignment, thank you!

## Paths

- IPN Listener & Verifier: _/listener.php_
- Checkout Page: _/checkout.php_ OR navigate with button in shopping cart
- Recent 5 Orders for Members: _/recentorders.php_ OR navigate with top bar


## Order Flow

As explained in the email, the flow is a bit different from the marking scheme. Once the Paypal checkout button is clicked in the separate checkout page, the digest of transaction info with the salt and hashed digest is uploaded to _orders_. After a successful payment, the IPN listener verifies the details and upload the transaction record to _record_. Only entries in _record_ are considered legitimate orders.


## Credentials

Please use the following Paypal Sandbox Accounts:

Buesiness Account:<br/>
ID: sb-n0zww15617805@business.example.com<br/>
PW: 98'!70Ss

User Account:<br/>
ID: sb-nnczk15618652@personal.example.com<br/>
PW: CcH<8NTT

## Bugs not solved

- I was not able to compute the SHA256-encrypted digest again with the same algorithm, as stringified JSON objects are different all the time.

Apart from the bug above, I have tried to make sure that everything is sticked to the marking scheme.