<section class="dashboard">
    <div class="main-stats">
        <div class="main-stat-item">
            <div class="main-stats-image-frame">
                <img
                    class="main-stats-image"
                    src="../assets/images/dashboardimages/totalNumberOfUsers.png"
                />
            </div>
            <div class="main-stat-item-text-section">
                <p class="main-stat-item-text-section-maintext">
                    Total user count
                </p>
                <p class="main-stat-item-text-section-number">
                    <?= htmlspecialchars($data['userCount']) ?>
                </p>
            </div>
        </div>

        <div class="main-stat-item">
            <div class="main-stats-image-frame img2">
                <img
                    class="main-stats-image"
                    src="../assets/images/dashboardimages/activeUsers.png"
                />
            </div>
            <div class="main-stat-item-text-section">
                <p class="main-stat-item-text-section-maintext">
                    Number of active admins
                </p>
                <p class="main-stat-item-text-section-number">
                    <?= htmlspecialchars($data['adminCount']) ?>
                </p>
            </div>
        </div>

        <div class="main-stat-item">
            <div class="main-stats-image-frame img3">
                <img
                    class="main-stats-image"
                    src="../assets/images/dashboardimages/eventsPic.png"
                />
            </div>
            <div class="main-stat-item-text-section">
                <p class="main-stat-item-text-section-maintext">
                    Events on website
                </p>
                <p class="main-stat-item-text-section-number">
                    <?= htmlspecialchars($data['eventCount']) ?>
                </p>
            </div>
        </div>
    </div>

    <div class="activities-and-categories">
        <div class="weekly-activity-section">
            <h2 class="activities-and-categories-section-header">
                Weekly Activity
            </h2>
            <img class="chart1" src="../assets/images/dashboardimages/BigAndScaryChart.png" />
        </div>
    </div>

    <div class="dashboard-bottom-section">
        <div class="additional-statistics-section">
            <h2 class="additional-statistics-section-header">
                Additional statistics
            </h2>
            <div class="additional-statistics-item">
                <div class="add-stats-image-frame">
                    <img
                        class="add-stats-image"
                        src="../assets/images/dashboardimages/BannedUsers.png"
                    />
                </div>
                <p class="add-stats-main-text">Number of banned users</p>
                <div class="add-stats-item-col">
                    <p class="add-stats-value"><?= htmlspecialchars($data['bannedCount']) ?></p>
                    <p class="add-stats-secondary-text">users</p>
                </div>

                <div class="add-stats-item-col">
                    <p class="add-stats-value plus">+16%</p>
                    <p class="add-stats-secondary-text">from last month</p>
                </div>
            </div>

            <div class="additional-statistics-item">
                <div class="add-stats-image-frame item2">
                    <img class="add-stats-image" src="../assets/images/dashboardimages/letter.png" />
                </div>
                <p class="add-stats-main-text">Number of event propositions</p>
                <div class="add-stats-item-col">
                    <p class="add-stats-value"><?= htmlspecialchars($data['propositionCount']) ?></p>
                    <p class="add-stats-secondary-text">events</p>
                </div>

                <div class="add-stats-item-col">
                    <p class="add-stats-value minus">-4%</p>
                    <p class="add-stats-secondary-text">from last month</p>
                </div>
            </div>

            <div class="additional-statistics-item">
                <div class="add-stats-image-frame item3">
                    <img class="add-stats-image" src="../assets/images/dashboardimages/FAQNum.png" />
                </div>
                <p class="add-stats-main-text">Number of FAQ questions</p>
                <div class="add-stats-item-col">
                    <p class="add-stats-value"><?= htmlspecialchars($data['faqCount']) ?></p>
                    <p class="add-stats-secondary-text">questions</p>
                </div>

                <div class="add-stats-item-col">
                    <p class="add-stats-value plus">+25%</p>
                    <p class="add-stats-secondary-text">from last month</p>
                </div>
            </div>
        </div>

        <div class="user-activity-section">
            <h2 class="user-activity-section-header">User Activity</h2>
            <img
                class="user-activity-pic"
                src="../assets/images/dashboardimages/UserActivity.png"
            />
        </div>
    </div>
</section>
