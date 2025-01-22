<script src="../../scripts/theme.js"></script>
<body>

 <div class="terms">
     <!-- Hero Section -->
     <section class="hero-section">
         <h1>Terms of Service</h1>
     </section>

     <!-- Terms Content -->
     <section class="terms-content">
         <?php foreach ($tacs as $tac): ?>
             <h2><?= htmlspecialchars($tac['conditionT']) ?></h2>
             <p><?= nl2br(htmlspecialchars($tac['detail'])) ?></p>
         <?php endforeach; ?>
     </section>
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
