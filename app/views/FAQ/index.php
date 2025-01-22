<body>

    <div class="faq">
        <!-- Hero Section -->
        <section class="hero-section">
            <h1>Frequently Asked Questions</h1>
        </section>

        <!-- Questions Section -->
        <section class="questions-section">
            <?php foreach ($faqs as $faq): ?>
                <div class="question">
                    <div class="question-header">
                        <h2><?= htmlspecialchars($faq['Question']) ?></h2>
                        <button class="toggle-button">
                            <img src="assets/images/toggle-icon.svg" alt="toggle" class="icon">
                        </button>
                    </div>
                    <div class="answer">
                        <p><?= nl2br(htmlspecialchars($faq['Answer'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
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