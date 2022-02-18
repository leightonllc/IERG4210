# IERG4210 Assignment Phase 2A & 2B

<img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" /> <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white" /> <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" /> <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" /> <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />

📚 Name: Lau Long Ching </br>
🗂️ SID: 1155127347

Please refer to https://github.com/leightonllc/IERG4210 for the git record.

## Phase 2A marking checklist
1. Instantiate a free Virtual Cloud Machine (Amazon EC2 recommended or other free VPS). <img src="https://img.shields.io/badge/-complete-green" align="right" />

2. Apply necessary security configurations. <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Apply proper firewall settings to your VM: block all ports except 22, 80 and 443 only <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Apply proper updates for the server software packages in a regular manner <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Hide the versions of OS, Apache, and PHP in HTTP response headers <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Do not display any PHP warnings and errors to the end users <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Disable directory index in Apache <img src="https://img.shields.io/badge/-complete-green" align="right" />

3. Configure the VM so that your website is accessible at http://s1155x.ierg4210.ie.cuhk.edu.hk <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />

- Apply for an elastic public IP, and ALWAYS associate it with the instantiated VM <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Submit your elastic IP through the provided Google Form link before 5pm, Feb 13, 2022 <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Submit your elastic IP through the provided Google Form link before 5pm, Feb 13, 2022 <img src="https://img.shields.io/badge/-complete-green" align="right" />
- TAs will then assign you a domain name and configure the DNS mapping for you <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />

## Phase 2B marking checklist

1. SQL: Create a database with the following structures <img src="https://img.shields.io/badge/-complete-green" align="right" />

- A table for categories <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Input boxes are used for inputting the quantity of each selected product <img src="https://img.shields.io/badge/-complete-green" align="right" />
- A table for products (supposed to submit the list to PayPal, currently no function) <img src="https://img.shields.io/badge/-complete-green" align="right" />

2.  HTML, PHP & SQL: Create an admin panel <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Design several HTML forms to manage products in DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Dropdown menu to select catid according to its name <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Input fields for inputting name, price <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - Textarea for inputting description <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - File field for uploading an image (format: jpg/gif/png, size: <=10MB) <img src="https://img.shields.io/badge/-complete-green" align="right" />
    - For the file uploaded, store it with its name based on the unique lastInsertId() (or other
3 reasonable ways) <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Design several HTML forms to manage categories in DB <img src="https://img.shields.io/badge/-complete-green" align="right" />

3. HTML, PHP, SQL: Update the main page created in Phase 1 <img src="https://img.shields.io/badge/-complete-green" align="right" />

- Populate the category list from DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Based on the category selected by the user, populate the corresponding product list from DB <img src="https://img.shields.io/badge/-complete-green" align="right" />
  - The catid=[x] is reflected as a query string in the URL <img src="https://img.shields.io/badge/-complete-green" align="right" />

4. HTML, PHP & SQL: Update the product details page created in Phase 1 <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Display the details of a product based on its DB record <img src="https://img.shields.io/badge/-complete-green" align="right" />
- Display the inventory of a product based on its DB record <img src="https://img.shields.io/badge/-complete-green" align="right" />

5. Support of automatic image resizing for product images <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />
- When a large image is uploaded, the server will resize it and show a thumbnail image in the panel <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />
- On the main page, display thumbnails. On the product description page, display the larger image. <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />

6. Supporting HTML5 Drag-and-drop file selection in the admin panel <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />
- Create a dropping area that takes an image <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />
- Display a thumbnail (i.e. smaller width and height) if the dropped file is an image; reject it otherwise <img src="https://img.shields.io/badge/-in%20progress-important" align="right" />

## Statistics
![Alt](https://repobeats.axiom.co/api/embed/ccd679e26c502ba65cea10ce16649805cc283af8.svg "Repobeats analytics image")
