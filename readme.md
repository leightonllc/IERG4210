# IERG4210 Assignment Phase 2A & 2B

<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" /> <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" /> <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" /> <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" /> <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />

📚 Name: Lau Long Ching </br>
🗂️ SID: 1155127347

Please refer to https://github.com/leightonllc/IERG4210 for the git record.

## Phase 2A marking checklist
1. Instantiate a free Virtual Cloud Machine (Amazon EC2 recommended or other free VPS). <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/1.png" align="center" /></br>
</p>
2. Apply necessary security configurations. <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Apply proper firewall settings to your VM: block all ports except 22, 80 and 443 only <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>

<img src="./assignment/2.png" align="center" /></br>
- Apply proper updates for the server software packages in a regular manner <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Hide the versions of OS, Apache, and PHP in HTTP response headers <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/3.png" align="center" /></br>
</p>
- Do not display any PHP warnings and errors to the end users <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Disable directory index in Apache <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/4.png" align="center" /></br>
</p>
3. Configure the VM so that your website is accessible at http://s1155127347.ierg4210.ie.cuhk.edu.hk <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Apply for an elastic public IP, and ALWAYS associate it with the instantiated VM <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Submit your elastic IP through the provided Google Form link before 5pm, Feb 13, 2022 <img src="https://img.shields.io/badge/-complete-green" align="right" />
- TAs will then assign you a domain name and configure the DNS mapping for you <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Upload all your pages to the server. They should then be accessible through:
  - http://3.13.126.10, or
  - http://s1155127347.ierg4210.ie.cuhk.edu.hk


## Phase 2B marking checklist

1. SQL: Create a database with the following structures <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/5.png" align="center" /></br></p>

- A table for categories <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Required columns: catid (primary key), name
  - Data: at least 2 categories of your choice
- A table for products (supposed to submit the list to PayPal, currently no function) <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Required columns: pid (primary key), catid, name, price, description
  - Data: at least 2 products for each category


2.  HTML, PHP & SQL: Create an admin panel http://3.13.126.10/admin/admin.php <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/6.png" align="center" /></br></p>

- Design several HTML forms to manage products in DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Dropdown menu to select catid according to its name <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Input fields for inputting name, price <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Textarea for inputting description <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - File field for uploading an image (format: jpg/gif/png, size: <=10MB) <img src="https://img.shields.io/badge/-complete-green" align="right" />
    - For the file uploaded, store it with its name based on the unique lastInsertId() (or other reasonable ways)
- Design several HTML forms to manage categories in DB <img src="https://img.shields.io/badge/-complete-green" align="right" />

3. HTML, PHP, SQL: Update the main page created in Phase 1 <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Populate the category list from DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Based on the category selected by the user, populate the corresponding product list from DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - The catid=[x] is reflected as a query string in the URL

4. HTML, PHP & SQL: Update the product details page created in Phase 1 <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Display the details of a product based on its DB record <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Display the inventory of a product based on its DB record <img src="https://img.shields.io/badge/-complete-green" align="right" />

5. Support of automatic image resizing for product images <img src="https://img.shields.io/badge/-complete-green" align="right" />
- When a large image is uploaded, the server will resize it and show a thumbnail image in the panel <img src="https://img.shields.io/badge/-complete-green" align="right" />
- On the main page, display thumbnails. On the product description page, display the larger image. <img src="https://img.shields.io/badge/-complete-green" align="right" />

6. Supporting HTML5 Drag-and-drop file selection in the admin panel <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Create a dropping area that takes an image <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/8.png" align="center" /></br></p>
- Display a thumbnail (i.e. smaller width and height) if the dropped file is an image; reject it otherwise <img src="https://img.shields.io/badge/-complete-green" align="right" /></br>
<p align="center">
<img src="./assignment/7.png" align="center" /></br></p>