<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Proyek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Proyek Details</h2>
        <a href="<?= base_url('proyek'); ?>" class="btn btn-secondary mb-3">Back to List</a>
        <a href="<?= base_url('proyek/edit/'.$proyek['data']['id']); ?>" class="btn btn-warning mb-3">Edit</a>
        <a href="#" class="btn btn-danger mb-3 delete-btn" data-id="<?= $proyek['data']['id']; ?>" data-type="proyek">Delete</a>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> <?= $proyek['data']['id']; ?></p>
                <p><strong>Nama Proyek:</strong> <?= $proyek['data']['namaProyek']; ?></p>
                <p><strong>Client:</strong> <?= $proyek['data']['client']; ?></p>
                <p><strong>Tanggal Mulai:</strong> <?= $proyek['data']['tglMulai']; ?></p>
                <p><strong>Tanggal Selesai:</strong> <?= $proyek['data']['tglSelesai']; ?></p>
                <p><strong>Pimpinan Proyek:</strong> <?= $proyek['data']['pimpinanProyek']; ?></p>
                <p><strong>Keterangan:</strong> <?= $proyek['data']['keterangan']; ?></p>

                <h4>Associated Locations</h4>
                <?php if (!empty($proyek['data']['proyekLokasiSet'])): ?>
                    <ul>
                        <?php foreach ($proyek['data']['proyekLokasiSet'] as $lokasi): ?>
                            <li>
                                <?= $lokasi['lokasi']['namaLokasi']; ?> (<?= $lokasi['lokasi']['kota']; ?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No associated locations.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action

                var id = $(this).data('id');
                var type = $(this).data('type');

                if (confirm('Are you sure you want to delete this ' + type + '?')) {
                    $.ajax({
                        url: '<?= base_url('api/') ?>' + type + '/' + id,
                        type: 'DELETE',
                        success: function(result) {
                            alert(type.charAt(0).toUpperCase() + type.slice(1) + ' deleted successfully');
                            window.location.href = '<?= base_url('proyek') ?>'; // Redirect to the list page
                        },
                        error: function(xhr, status, error) {
                            alert('Failed to delete ' + type);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
