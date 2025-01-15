<section class="event-proposition-section">
    <h1 class="main-heading text">Active Users</h1>
    <div class="event-proposition-table">
        <!-- Table Header -->
        <div class="event-proposition-table-header-column column1">
            <span class="event-proposition-table-header-text text">Username</span>
        </div>
        <div class="event-proposition-table-header-column column2">
            <span class="event-proposition-table-header-text text">Email</span>
        </div>
        <div class="event-proposition-table-header-column column3">
            <span class="event-proposition-table-header-text text">Name</span>
        </div>
        <div class="event-proposition-table-header-column column4">
            <span class="event-proposition-table-header-text text">Phone number</span>
        </div>
        <div class="event-proposition-table-header-column column5 column5--head">
            <span class="event-proposition-table-header-text text">Birth date</span>
        </div>
        <div class="breakline"></div>
        <!-- Table Header End -->

        <!-- Loop through users -->
        <?php foreach ($users as $user): ?>
            <div class="event-proposition-table-column-data column1">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($user['Username']); ?></span>
            </div>
            <div class="event-proposition-table-column-data column2">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($user['Email']); ?></span>
            </div>
            <div class="event-proposition-table-column-data column3">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($user['FullName']); ?></span>
            </div>
            <div class="event-proposition-table-column-data column4">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($user['Phone']); ?></span>
            </div>
            <div class="event-proposition-table-column-data column5 text">
                <span class="event-proposition-table-body-text-date"><?= htmlspecialchars($user['DateOfBirth']); ?></span>
            </div>
            <div class="event-proposition-table-buttons column6">
                <form action="/ban/<?php echo $user['UserID'] ?>" method="POST">
                    <button  type="submit" class="event-proposition-button reject-button"=>
                        <span class="button-text">ban</span>
                    </button>
                </form>
                <a href="<?php echo   '/profile/' . $user['Username']; ?>" class="event-proposition-button view-button" >
                    <span class="button-text">VIEW</span>
                </a>
            </div>
            <div class="breakline"></div>
        <?php endforeach; ?>
    </div>
</section>
