<?php 
// Inclusion du header commun
include_once __DIR__ . '/../layout/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Événements à venir</h1>
    
    <div class="row">
        <?php if (empty($events)): ?>
            <div class="col-12">
                <div class="alert alert-info">Aucun événement à venir.</div>
            </div>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($event['image_path']) && file_exists(__DIR__ . '/../' . $event['image_path'])): ?>
                            <img src="<?= $event['image_path'] ?>" class="card-img-top" alt="<?= htmlspecialchars($event['titre']) ?>">
                        <?php else: ?>
                            <div class="card-img-top bg-light text-center py-5">
                                <i class="bi bi-calendar-event display-4"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['titre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($event['description'], 0, 100)) ?>...</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> <?= date('d/m/Y', strtotime($event['date'])) ?> à <?= date('H:i', strtotime($event['heure'])) ?>
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($event['lieu']) ?>
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="bi bi-people"></i> <?= $event['inscrit_count'] ?> inscrits
                                </small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="event?id=<?= $event['id_evenement'] ?>" class="btn btn-primary btn-sm">Voir détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php 
// Inclusion du footer commun
include_once __DIR__ . '/../layout/footer.php';
?> 