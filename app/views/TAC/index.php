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

</body>
