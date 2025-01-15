<section class="event-proposition-section">
    <h1 class="main-heading text">Accepted events</h1>
    <div class="event-proposition-table">

        <!-- Table Header -->
        <div class="event-proposition-table-header-column column1">
            <span class="event-proposition-table-header-text text">Title</span>
        </div>
        <div class="event-proposition-table-header-column column2">
            <span class="event-proposition-table-header-text text">Location</span>
        </div>
        <div class="event-proposition-table-header-column column3">
            <span class="event-proposition-table-header-text text">Max attendants</span>
        </div>
        <div class="event-proposition-table-header-column column4">
            <span class="event-proposition-table-header-text text">from</span>
        </div>
        <div class="event-proposition-table-header-column column5 column5--head">
            <span class="event-proposition-table-header-text text">to</span>
        </div>
        <div class="breakline"></div>

        <!-- Dynamic Table Rows -->
        <?php foreach ($events as $event): ?>
            <div class="event-proposition-table-column-data column1">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($event['EventName']) ?></span>
            </div>
            <div class="event-proposition-table-column-data column2">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($event['LocationName']) ?></span>
            </div>
            <div class="event-proposition-table-column-data column3">
                <span class="event-proposition-table-body-text text"><?= htmlspecialchars($event['MaxParticipants']) ?></span>
            </div>
            <div class="event-proposition-table-column-data column4 text">
            <span class="event-proposition-table-body-text-month"><?= htmlspecialchars($event['StartDate']) ?></span>
            </div>
            <div class="event-proposition-table-column-data column5 text">
                 <span class="event-proposition-table-body-text-month"><?= htmlspecialchars($event['EndDate']) ?></span>
            </div>
            <div class="event-proposition-table-buttons column6">
                <form action="/moveToProp/<?php echo $event['EventID'] ?>" method="POST">
                        <button  type="submit" class="event-proposition-button reject-button"=>
                            <span class="button-text">remove</span>
                        </button>
                </form>
                <a href="event/<?= urlencode($event['EventID']) ?>" class="event-proposition-button view-button">
                    <span class="button-text">view</span>
                </a>
            </div>
            <div class="breakline"></div>
        <?php endforeach; ?>
    </div>
</section>
