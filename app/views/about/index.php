
<body>

    <div class="about-us">
        <!-- Hero Section -->
        <section class="hero-section">
            <h1>About us</h1>
        </section>
        <div class="paragraph-section">
            <p>
                We are the <span class="highlight">Digital Dreamers</span>, a dedicated team of visionaries 
                passionate about harnessing technology to make life simpler and more connected. Our purpose 
                in creating <b>Planet</b><span class="highlight">There</span> is to revolutionize the way people 
                discover and manage events, ensuring that everyone can access their favorite experiences 
                with ease. Through innovation and collaboration, we strive to bring communities together, 
                one event at a time.
            </p>
        </div>
        

        <div class="overview-section">
            <div class="overview-item">
                <h3>FUNDING</h3>
                <h2>None !</h2>
                <p>PlanetThere is fully self-funded</p>
            </div>
            <div class="overview-item">
                <h3>FOUNDED</h3>
                <h2>2024</h2>
                <p>Digital Dreamers assembled in October of 2024</p>
            </div>
            <div class="overview-item">
                <h3>LOCATED IN</h3>
                <h2>Paris, FR</h2>
                <p>Entirely built in Paris</p>
            </div>
            <div class="overview-item">
                <h3>UNIVERSITY</h3>
                <h2>ISEP</h2>
                <p>Built in association with <i>Institut supérieur d'électronique de Paris</i></p>
            </div>
            <div class="overview-item">
                <h3>GOAL</h3>
                <h2>Events availibilty</h2>
                <p>All your favourite events in one place</p>
            </div>
            <div class="overview-item">
                <h3>OUR VALUES</h3>
                <h2>For everyone</h2>
                <p>Everyone can be a manager</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = localStorage.getItem('theme') || 'light';

            // If the theme is dark, apply the dark mode class to body
            if (currentTheme === 'dark') {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        });
    </script>
</body>
