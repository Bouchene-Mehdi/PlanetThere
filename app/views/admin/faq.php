
<section class="faq">

    <?php foreach ($faqs as $faq): ?>
        <div class="question">
            <div class="question-header">
                <h2><?php echo htmlspecialchars($faq['Question']); ?></h2>
                <div class="icons">
                    <!-- Remove Button -->
                    <form action="/AdminFaq/Delete/<?php echo $faq['FaqID']; ?>" method="POST">
                        <button class="remove-button" type="submit" name="faq_id" value="<?php echo $faq['FaqID']; ?>">
                            <img src="assets/images/trash.svg" class="trash" alt="Remove" class="icon">
                        </button>
                    </form>

                    <!-- Toggle Button -->
                    <button type="button" class="toggle-button">
                        <img src="assets/images/toggle-icon.svg" alt="Toggle" class="icon">
                    </button>
                </div>
            </div>
            <div class="answer">
                <p>
                    <?php echo htmlspecialchars($faq['Answer']); ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>

    <form action="/AdminFaq/Add" method="POST">
        <div class="new-faq-item">
            <div class="new-question-input">
                <input type="text" name="question" placeholder="Enter a question for the new section here" required />
            </div>
            <hr class="divider" />

            <div class="new-answer-input">
                <textarea name="answer" placeholder="Enter the answer of the question here" required></textarea>
            </div>
            <div class="new-add-button-container">
                <button class="new-add-button" type="submit">
                    <img src="assets/images/plus.svg" style="width:20px" alt="Add" />
                </button>
            </div>
        </div>
    </form>




 </section>
    

    <script>
        document.querySelectorAll('.question-header').forEach(header => {
            header.addEventListener('click', (event) => {
                // Check if the clicked element is a button or its child
                const target = event.target.closest('button');
                
                if (target && target.classList.contains('toggle-button')) {
                    const answer = header.nextElementSibling;

                    if (answer) {
                        answer.classList.toggle('active');
                        target.classList.toggle('active');
                    }
                }
            });
        });

    </script>


