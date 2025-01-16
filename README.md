# PlanetThere

<img src="https://github.com/user-attachments/assets/306b5a9b-ce0a-4376-896d-5206ca67150e" alt="logo" width="60" height="60"/>
<img src="https://github.com/user-attachments/assets/81ffcfda-01ef-4bb4-b3d6-c9263aa3bac5" alt="logo-text" width="282" height="40"/>




PlanetThere is a dynamic platform designed to connect event creators and attendees. It facilitates seamless event management, registration, and interaction for users in an intuitive and visually appealing environment. The project was completed for the Web Development Module at Institut supérieur d'électronique de Paris.

---

## Project Overview
PlanetThere is a platform built using HTML, CSS, JavaScript, PHP and a MySQL database. It follows the Model-View-Controller (MVC) architecture. It offers event attendees and creators tools to interact, manage, and participate in events effortlessly. With user-friendly features like registration, waitlisting, and event moderation, PlanetThere ensures a seamless experience for all users.

---

## Features

### For Attendees
- Create and manage accounts, including profile customization.
- Search for events using keywords or advanced filtering.
- Register for events or join a waitlist when full.
- Review and comment on attended events
- Follow other users and view their activity.
- Block or unblock users.
- View attended event history.

### For Event Creators
- Create, update, and delete events.
- Easily plan frequent events with templates.
- Remove participants from events.

### For Admins
- Moderate user-generated content and ban/unban users.
- Approve, deny, or remove events violating policies.
- Customize and manage the FAQ page.

---

## Technology Stack
- **Languages**: HTML, CSS, JavaScript, PHP
- **Architecture**: Model-View-Controller (MVC)
- **Database**: Uses PHP for backend data handling
- **No Frameworks**: The project is built from the ground up using native technologies.

---

## Project Structure

```plaintext
+---.vscode
+---app
|   +---controllers
|   +---core
|   +---models
|   +---PhpMailer
|   \---views
|       +---about
|       +---admin
|       +---event
|       +---FAQ
|       +---home
|       +---partials
|       +---TAC
|       \---user
+---config
+---controllers
+---helpers
+---models
+---public
|   +---assets
|   |   +---css
|   |   +---fonts
|   |   |   \---fontawesome-free-6.7.2-web
|   |   |       +---css
|   |   |       +---js
|   |   |       +---less
|   |   |       +---metadata
|   |   |       +---scss
|   |   |       +---sprites
|   |   |       +---svgs
|   |   |       |   +---brands
|   |   |       |   +---regular
|   |   |       |   \---solid
|   |   |       \---webfonts
|   |   \---images
|   |       +---dashboardimages
|   |       \---sidebarpics
|   \---uploads
|       +---events
|       \---users
+---routes
\---views
    \---layout
```


---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/username/planetthere.git
   ```
2. Navigate to the project directory:
   ```bash
   cd planetthere
   ```
3. Set up your server environment:
   - Install a local server like XAMPP or WAMP.
   - Place the project in the `htdocs` folder.
4. Import the database:
   - Locate the `planetthere_new.sql` file in the project.
   - Use phpMyAdmin to import it into your database.
5. Configure the project:
   - Edit the `config` files with your database credentials if needed.
6. Launch the application:
   - Open the project in your browser using `http://localhost/`.

---


## Visual Highlights

<div style="display: flex; justify-content: space-between; gap: 20px;">
  <img src="https://github.com/user-attachments/assets/65be6ac3-f0eb-4f52-a89f-00d266b9ee76" alt="Home Page" width="48%" />
  <img src="https://github.com/user-attachments/assets/877569ae-6cfe-4557-b6c9-ffbb625be9e5" alt="Event Page" width="48%" />
</div>

<div style="display: flex; justify-content: space-between; gap: 20px; margin-top: 20px;">
  <img src="https://github.com/user-attachments/assets/314b6623-01ae-4448-b695-074c44cc4ffd" alt="User Profile" width="48%" />
  <img src="https://github.com/user-attachments/assets/a5d7b19f-f973-40c6-8254-5151959141ca" alt="Admin Panel" width="48%" />
</div>



---

## License

PlanetThere is licensed under the [MIT License](LICENSE).

---

## Contact
For questions or support, reach out to [kacperj2022@gmail.com](mailto:kacperj2022@gmail.com).

---

## Acknowledgments

Special thanks to everyone who contributed to this project and helped make PlanetThere a reality.

