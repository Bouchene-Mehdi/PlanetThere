
    <div class="faq">
        <!-- Hero Section -->
        <section class="hero-section">
            <h1>Frequently Asked Questions</h1>
        </section>
    
        <!-- Questions Section -->
        <section class="questions-section">
            <div class="question">
                <div class="question-header">
                    <h2>What is PlanetThere?</h2>
                    <button class="toggle-button">
                        <img src="assets/images/toggle-icon.svg" alt="toggle" class="icon">
                    </button>
                </div>
                <div class="answer">
                    <p>
                        PlanetThere is an event management platform that allows users to create, promote, and participate in various events. Whether you're an event planner or an attendee, PlanetThere simplifies the process and enhances your event experience.
                    </p>
                </div>
            </div>
    
            <div class="question">
                <div class="question-header">
                    <h2>How do I create an account?</h2>
                    <button class="toggle-button">
                        <img src="assets/images/toggle-icon.svg" alt="toggle" class="icon">
                    </button>
                </div>
                <div class="answer">
                    <p>
                        Creating an account on PlanetThere is simple and quick. Click on the "Sign Up" button located at the top right corner of the website. Have your email address at hand because you will need it to finalize the sing up process.
                    </p>
                </div>
            </div>
    
            <div class="question">
                <div class="question-header">
                    <h2>How do I create my own event?</h2>
                    <button class="toggle-button">
                        <img src="assets/images/toggle-icon.svg" alt="toggle" class="icon">
                    </button>
                </div>
                <div class="answer">
                    <p>
                        To create your own event on PlanetThere, log in to your account and navigate to the "Create Event" section. Fill in the event details such as title, description, date, time, location, and any other relevant information. Once you've entered all the details, click "Publish" to make your event live and start promoting it to potential attendees.
                    </p>
                </div>
            </div>
    
            <div class="question">
                <div class="question-header">
                    <h2>How does PlanetThere ensure event quality?</h2>
                    <button class="toggle-button">
                        <img src="assets/images/toggle-icon.svg" alt="toggle" class="icon">
                    </button>
                </div>
                <div class="answer">
                    <p>
                        PlanetThere is committed to maintaining high-quality events on its platform. We implement a thorough vetting process for all event organizers, ensuring they meet our standards. Additionally, we provide tools and resources to help organizers create engaging and well-managed events. Our support team actively monitors events and user feedback to address any issues promptly. By fostering a community of responsible organizers and attentive users, PlanetThere ensures a positive and enriching event experience for everyone.
                    </p>
                </div>
            </div>
        </section>
    </div>
    

    <script>
        document.querySelectorAll('.question-header').forEach(header => {
            header.addEventListener('click', () => {
                const answer = header.nextElementSibling;
                const button = header.querySelector('.toggle-button');

                if (answer) {
                    answer.classList.toggle('active');
                    button.classList.toggle('active');
                }
            });
        });
    </script>

</body>

